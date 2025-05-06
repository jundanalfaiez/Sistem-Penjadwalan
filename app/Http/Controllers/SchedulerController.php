<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Models\Hari;
use App\Models\Waktu;
use App\Models\Jadwal;
use App\Exports\ScheduleExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SchedulerController extends Controller
{
    private $population_size = 50;
    private $mutation_rate = 0.1;
    private $generations = 100;

    public function index()
    {
        return view('scheduler.index');
    }

    public function store(Request $request)
    {
        
        // Validasi input dari form
        $validated = $request->validate([
            'nama_ruangan' => 'required|string|max:255',
            'hari' => 'required|string|max:255',
            'waktu' => 'required|date_format:H:i',
        ]);

        // Simpan data ke database dengan created_by
        Ruangan::create([
            'nama_ruangan' => $validated['nama_ruangan'],
            'created_by' => auth()->id(),
        ]);

        Hari::create([
            'hari' => $validated['hari'],
            'created_by' => auth()->id(),
        ]);

        Waktu::create([
            'jam_mulai' => $validated['waktu'],
            'jam_selesai' => $validated['waktu'],
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('scheduler.index')->with('message', 'Data berhasil disimpan!');
    }

    public function schedule(Request $request)
    {
        // Mengecek apakah data yang dibutuhkan ada
        if (
            Ruangan::where('created_by', auth()->id())->count() == 0 ||
            Hari::where('created_by', auth()->id())->count() == 0 ||
            Waktu::where('created_by', auth()->id())->count() == 0 ||
            Jadwal::where('created_by', auth()->id())->count() == 0
        ) {
            return redirect()->route('scheduler.index')->with('error', 'Data awal tidak lengkap. Pastikan data ruangan, hari, jam, dan jadwal sudah tersedia.');
        }

        $result = $this->runGeneticAlgorithm();

        if (isset($result['error'])) {
            return redirect()->route('scheduler.index')->with('error', $result['error']);
        }

        return view('scheduler.index', [
            'schedule' => $result['schedule'],
            'generation' => $result['generation'],
        ]);
    }

    public function exportToExcel()
    {
        $result = session('generated_schedule');

        if (!$result) {
            return redirect()->route('scheduler.index')->with('error', 'Jadwal belum dihitung.');
        }

        return Excel::download(new ScheduleExport($result), 'jadwal.xlsx');
    }

    public function exportToPdf()
    {
        $result = session('generated_schedule');

        if (!$result) {
            return redirect()->route('scheduler.index')->with('error', 'Jadwal belum dihitung.');
        }

        $pdf = Pdf::loadView('scheduler.pdf', ['schedule' => $result]);

        return $pdf->download('jadwal.pdf');
    }

    private function generateChromosome()
    {
        $ruangan = Ruangan::where('created_by', auth()->id())->inRandomOrder()->first();
        $hari = Hari::where('created_by', auth()->id())->inRandomOrder()->first();
        $waktu = Waktu::where('created_by', auth()->id())->inRandomOrder()->first();
        $jadwal = Jadwal::where('created_by', auth()->id())->with(['matakuliah', 'dosen', 'periode'])->inRandomOrder()->first();

        if (!$ruangan || !$hari || !$waktu || !$jadwal || !$jadwal->dosen || !$jadwal->periode) {
            throw new \Exception('Data tidak lengkap untuk membuat kromosom.');
        }

        return [
            'ruangan_id' => $ruangan->id,
            'ruangan' => $ruangan->nama_ruangan,
            'hari_id' => $hari->id,
            'hari' => $hari->hari,
            'waktu_id' => $waktu->id,
            'waktu' => $waktu->jam_mulai . ' - ' . $waktu->jam_selesai,
            'jadwal_id' => $jadwal->id,
            'matakuliah' => $jadwal->matakuliah->nama_matakuliah,
            'type_matakuliah' => $jadwal->matakuliah->type_matakuliah,
            'dosen' => $jadwal->dosen->nama,
            'periode' => $jadwal->periode->name,
        ];
    }

    private function generatePopulation()
    {
        $population = [];
        for ($i = 0; $i < $this->population_size; $i++) {
            $population[] = $this->generateChromosome();
        }
        return $population;
    }

    private function calculateFitness($chromosome, $population)
    {
        $conflicts = 0;

        foreach ($population as $other) {
            if ($chromosome === $other) continue;

            if (
                $chromosome['ruangan_id'] === $other['ruangan_id'] &&
                $chromosome['hari_id'] === $other['hari_id'] &&
                $chromosome['waktu_id'] === $other['waktu_id']
            ) {
                $conflicts++;
            }

            if (
                $chromosome['jadwal_id'] === $other['jadwal_id'] &&
                $chromosome['hari_id'] === $other['hari_id'] &&
                $chromosome['waktu_id'] === $other['waktu_id']
            ) {
                $conflicts++;
            }
        }

        return $conflicts;
    }

    private function selectParents($population, $fitnesses)
    {
        $tournament = collect($population)->zip($fitnesses)->random(5);
        $sorted = $tournament->sortBy(fn($item) => $item[1]);
        return $sorted->first()[0];
    }

    private function crossover($parent1, $parent2)
    {
        $point = rand(1, 3);

        $child1 = array_merge(array_slice($parent1, 0, $point), array_slice($parent2, $point));
        $child2 = array_merge(array_slice($parent2, 0, $point), array_slice($parent1, $point));

        return [$child1, $child2];
    }

    private function mutate($chromosome)
    {
        if (rand(0, 100) / 100 < $this->mutation_rate) {
            $index = rand(0, 3);
            switch ($index) {
                case 0:
                    $ruangan = Ruangan::where('created_by', auth()->id())->inRandomOrder()->first();
                    $chromosome['ruangan_id'] = $ruangan->id;
                    $chromosome['ruangan'] = $ruangan->nama_ruangan;
                    break;
                case 1:
                    $hari = Hari::where('created_by', auth()->id())->inRandomOrder()->first();
                    $chromosome['hari_id'] = $hari->id;
                    $chromosome['hari'] = $hari->hari;
                    break;
                case 2:
                    $waktu = Waktu::where('created_by', auth()->id())->inRandomOrder()->first();
                    $chromosome['waktu_id'] = $waktu->id;
                    $chromosome['waktu'] = $waktu->jam_mulai; // Tambahkan nilai default
                    break;
                case 3:
                    $jadwal = Jadwal::where('created_by', auth()->id())->with(['matakuliah', 'dosen', 'periode'])->inRandomOrder()->first();
                    $chromosome['jadwal_id'] = $jadwal->id;
                    $chromosome['matakuliah'] = $jadwal->matakuliah->nama_matakuliah;
                    $chromosome['dosen'] = $jadwal->dosen->nama;
                    $chromosome['periode'] = $jadwal->periode->name;
                    break;
            }
        }
        return $chromosome;
    }

    public function runGeneticAlgorithm()
    {
        try {
            $population = $this->generatePopulation();
            $allSchedules = [];

            for ($generation = 0; $generation < $this->generations; $generation++) {
                $fitnesses = array_map(
                    fn($chromosome) => $this->calculateFitness($chromosome, $population),
                    $population
                );

                if (min($fitnesses) === 0) {
                    foreach ($population as $chromosome) {
                        if ($this->calculateFitness($chromosome, $population) == 0) {
                            $allSchedules[] = $chromosome;
                        }
                    }

                    $allSchedules = $this->sortSchedule($allSchedules);

                    // Simpan jadwal yang sudah dihasilkan ke session
                    session(['generated_schedule' => $allSchedules]);

                    return ['schedule' => $allSchedules, 'generation' => $generation];
                }

                $new_population = [];
                for ($i = 0; $i < $this->population_size / 2; $i++) {
                    $parent1 = $this->selectParents($population, $fitnesses);
                    $parent2 = $this->selectParents($population, $fitnesses);
                    [$child1, $child2] = $this->crossover($parent1, $parent2);
                    $new_population[] = $this->mutate($child1);
                    $new_population[] = $this->mutate($child2);
                }

                $population = $new_population;
            }

            $fitnesses = array_map(
                fn($chromosome) => $this->calculateFitness($chromosome, $population),
                $population
            );
            foreach ($population as $chromosome) {
                if ($this->calculateFitness($chromosome, $population) == 0) {
                    $allSchedules[] = $chromosome;
                }
            }

            $allSchedules = $this->sortSchedule($allSchedules);

            // Simpan jadwal yang sudah dihasilkan ke session
            session(['generated_schedule' => $allSchedules]);

            return ['schedule' => $allSchedules, 'generation' => $this->generations];
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    private function sortSchedule($schedules)
    {
        $hariUrut = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];

        usort($schedules, function ($a, $b) use ($hariUrut) {
            $hariA = array_search($a['hari'], $hariUrut);
            $hariB = array_search($b['hari'], $hariUrut);

            if ($hariA === $hariB) {
                return strtotime(explode(' - ', $a['waktu'])[0]) <=> strtotime(explode(' - ', $b['waktu'])[0]);
            }

            return $hariA <=> $hariB;
        });

        return $schedules;
    }
}
