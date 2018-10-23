<?php

use Illuminate\Database\Seeder;

class MasterPerformanceEvaluationPaf extends Seeder
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
                'key' => 'ni',
                'evaluation'=>'Needs Improvement'
            ],
            [
                'key' => 'me',
                'evaluation'=>'Met Expectations'
            ],
            [
                'key' => 'ee',
                'evaluation'=>'Exceeds Expectations'
            ],
        ];

        foreach ($values as $value)
        {
            \App\Master\MasterPerformanceEvaluationPaf::create($value);
        }
    }
}
