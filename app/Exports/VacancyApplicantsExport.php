<?php

namespace App\Exports;

use App\Models\Vacancy;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VacancyApplicantsExport implements FromCollection, WithHeadings
{
    protected $vacancy;

    public function __construct($vacancy)
        {
            $this->vacancy = $vacancy;
        }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->vacancy->applications->map(function ($applicant) {
            return [
                'name'       => $applicant->user->name,
                'email'      => $applicant->user->email,
                'applied_at' => $applicant->created_at->toDateTimeString(),
            ];
        });
    }

   
    public function headings(): array
    {
        return [
            'nama',
            'Email',
            'Applied At',
        ];
    }
}
