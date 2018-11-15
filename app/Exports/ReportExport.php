<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReportExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $report;

    public function __construct($employee)
    {
        $this->report = $employee;
    }

    public function collection()
    {
        return $this->report;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        $keys = [];
        foreach ($this->report as $item => $value) {
            foreach ($value as $v => $s) {
                $keys[] = $v;
            }
            return $keys;
        }


    }
}
