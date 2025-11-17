<?php

namespace App\Exports;

use App\Models\Application;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ApplicationsExport implements FromCollection, WithHeadings, WithStyles
{
    protected $jobId;
    
    public function __construct($jobId = null)
    {
        $this->jobId = $jobId;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $query = Application::with('user', 'job');
        
        // Filter berdasarkan job jika jobId tersedia
        if ($this->jobId) {
            $query->where('job_id', $this->jobId);
        }
        return $query->get()->map(function($app) {
            return [
                'No' => $app->id,
                'Nama Pelamar' => $app->user->name,
                'Email' => $app->user->email,
                'Posisi' => $app->job->title,
                'Tipe Pekerjaan' => $app->job->employment_type ?? '-',
                'Status' => $app->status ?? 'Pending',
                'Tanggal Melamar' => $app->created_at ? $app->created_at->format('d-m-Y H:i') : '-',
                'CV' => $app->cv ? basename($app->cv) : '-',
            ];
        });
    }
    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'No',
            'Nama Pelamar',
            'Email',
            'Posisi',
            'Tipe Pekerjaan',
            'Status',
            'Tanggal Melamar',
            'File CV',
        ];
    }

    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Style header row
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => '4F46E5']],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, 'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER],
            ],
        ];
    }
}
