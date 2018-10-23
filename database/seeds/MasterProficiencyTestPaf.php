<?php

use Illuminate\Database\Seeder;

class MasterProficiencyTestPaf extends Seeder
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
                'key' => 'pass',
                'proficiency'=>'Passed'
            ],
            [
                'key' => 'fail',
                'proficiency'=>'Failed'
            ],
        ];

        foreach ($values as $value)
        {
            \App\Master\MasterProficiencyTestPaf::create($value);
        }
    }
}
