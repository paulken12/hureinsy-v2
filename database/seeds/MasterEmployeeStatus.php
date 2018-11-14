<?php

use Illuminate\Database\Seeder;

class MasterEmployeeStatus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $values = [
            [
                'key'=>'project-based',
                'employee_status'=>'Project-based'
            ],
            [
                'key'=>'regular',
                'employee_status'=>'Regular'
            ],
            [
                'key'=>'probationary',
                'employee_status'=>'Probationary'
            ],
            [
                'key'=>'separated',
                'employee_status'=>'Separated'
            ],

        ];

        foreach ($values as $value)
        {
            \App\Master\MasterEmpStatus::create($value);
        }
    }
}
