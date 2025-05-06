<?php

namespace App\Exports;

use App\Models\Scheduler;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ScheduleExport implements FromCollection, WithHeadings
{
    protected $schedule;

    public function __construct($schedule)
    {
        $this->schedule = $schedule;
    }

    public function collection()
    {
        return collect($this->schedule)->map(function ($item) {
            return [
                
                'Hari' => $item['hari'],
                'Waktu' => $item['waktu'],
                'Matakuliah' => $item['matakuliah'],
                'Periode' => $item['periode'],
                'Dosen' => $item['dosen'],
                'Ruangan' => $item['ruangan'],
            ];
        });
    }

    public function headings(): array
    {
        return [
            
            'Hari',
            'Waktu',
            'Matakuliah',
            'Semester',
            'Dosen',
            'Ruangan',
        ];
    }
}
