<?php

namespace App\Imports;

use App\Models\Job;
use App\Models\JobVacancy;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class JobsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new JobVacancy([
            'title' => $row['title'] ?? null,
            'description' => $row['description'] ?? null,
            'location' => $row['location'] ?? null,
            'company' => $row['company'] ?? null,
            'salary' => $row['salary'] ?? null,
            'employment_type' => $row['employment_type'] ?? null,
        ]);
    }
}
