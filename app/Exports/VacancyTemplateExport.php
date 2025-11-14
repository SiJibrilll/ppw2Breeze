<?php

namespace App\Exports;

use App\Models\Vacancy;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VacancyTemplateExport implements FromArray, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array() : array
    {
        return [
            ['Software Engineer', 'TechCorp', 'Jakarta', '10000000'],
        ];
    }

    function headings() : array {
        return  [
            'title',
            'company',
            'location',
            'salary',
        ];
    }
}
