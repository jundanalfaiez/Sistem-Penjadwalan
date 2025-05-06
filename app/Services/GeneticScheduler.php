<?php

namespace App\Services;

use App\Models\Matakuliah;
use App\Models\Ruangan;
use App\Models\Jadwal;

class GeneticScheduler
{
    protected $populationSize = 100;
    protected $generations = 500;
    protected $mutationRate = 0.1;
    protected $matakuliah;
    protected $ruang;

    public function __construct()
    {
        $this->matakuliah = Matakuliah::all();
        $this->ruang = Ruangan::all();
    }

    // Membuat populasi awal
    public function initializePopulation()
    {
        $population = [];
        for ($i = 0; $i < $this->populationSize; $i++) {
            $population[] = $this->generateSchedule();
        }
        return $population;
    }

    // Membuat jadwal acak
    public function generateSchedule()
    {
        $schedule = [];
        foreach ($this->matakuliah as $matakuliah) {
            $ruang = $this->ruang->random();
            $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'][rand(0, 4)];
            $jam_mulai = rand(8, 16) . ':' . rand(0, 59);

            $schedule[] = [
                'matakuliah_id' => $matakuliah->id,
                'ruang_id' => $ruang->id,
                'hari' => $hari,
                'jam_mulai' => $jam_mulai
            ];
        }
        return $schedule;
    }

    // Fungsi fitness untuk mengevaluasi jadwal
    public function fitnessFunction($schedule)
    {
        $conflicts = 0;
        foreach ($schedule as $i => $jadwal1) {
            foreach ($schedule as $j => $jadwal2) {
                if ($i < $j && $jadwal1['hari'] == $jadwal2['hari'] && $jadwal1['jam_mulai'] == $jadwal2['jam_mulai']) {
                    $conflicts++;
                }
            }
        }
        return $conflicts;
    }

    // Seleksi: memilih dua individu berdasarkan fitness (semakin sedikit konflik, semakin baik)
    public function selection($population)
    {
        usort($population, function ($a, $b) {
            return $this->fitnessFunction($a) <=> $this->fitnessFunction($b);
        });
        return array_slice($population, 0, 2); // memilih dua individu terbaik
    }

    // Crossover untuk menghasilkan individu baru
    public function crossover($parent1, $parent2)
    {
        $crossoverPoint = rand(0, count($parent1) - 1);
        $child = array_merge(
            array_slice($parent1, 0, $crossoverPoint),
            array_slice($parent2, $crossoverPoint)
        );
        return $child;
    }

    // Mutasi untuk memperkenalkan variasi
    public function mutate($schedule)
    {
        if (rand(0, 100) / 100 < $this->mutationRate) {
            $randomIndex = rand(0, count($schedule) - 1);
            $schedule[$randomIndex]['ruang_id'] = $this->ruang->random()->id;
            $schedule[$randomIndex]['hari'] = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'][rand(0, 4)];
        }
        return $schedule;
    }

    // Algoritma Genetika utama
    public function run()
    {
        $population = $this->initializePopulation();

        for ($generation = 0; $generation < $this->generations; $generation++) {
            $newPopulation = [];

            // Seleksi dan crossover
            $parents = $this->selection($population);
            $parent1 = $parents[0];
            $parent2 = $parents[1];

            $child = $this->crossover($parent1, $parent2);
            $child = $this->mutate($child);

            $newPopulation[] = $child;

            $population = $newPopulation;
        }

        return $population;
    }
}
