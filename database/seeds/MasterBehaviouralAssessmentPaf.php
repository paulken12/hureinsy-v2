<?php

use Illuminate\Database\Seeder;

class MasterBehaviouralAssessmentPaf extends Seeder
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
                'key' => 'mie',
                'behaviour'=>'Major Infractions Existing'
            ],
            [
                'key' => 'nmi',
                'behaviour'=>'No Major Infractions'
            ],
        ];

        foreach ($values as $value)
        {
            \App\Master\MasterBehaviouralAssessmentPaf::create($value);
        }
    }
}
