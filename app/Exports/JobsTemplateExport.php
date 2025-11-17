<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class JobsTemplateExport implements FromArray, WithHeadings
{
    /**
     * Return rows for the spreadsheet. We provide a single example row to
     * guide the admin; they can remove or overwrite it before importing.
     *
     * @return array
     */
    public function array(): array
    {
        return [
            [
                'Contoh Judul Pekerjaan',
                'Contoh deskripsi singkat pekerjaan',
                'Jakarta',
                'Nama Perusahaan',
                '5000000',
                'Full-time',
                '' // logo (opsional)
            ],
        ];
    }

    /**
     * Headings used by the import. These should match what the import expects.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'title',
            'description',
            'location',
            'company',
            'salary',
            'employment_type',
            'logo'
        ];
    }
}
