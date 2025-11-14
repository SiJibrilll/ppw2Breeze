<?php

namespace App\Imports;

use App\Models\Vacancy;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VacancyImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Vacancy([
            'title' => $row['title'],
            'company' => $row['company'],
            'location' => $row['location'],
            'salary' => $row['salary'],
        ]);
    }
}
