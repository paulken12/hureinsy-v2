<?php

use Illuminate\Database\Seeder;

class MasterOverallRecommendationPaf extends Seeder
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
                'key' => 'nrd',
                'overall'=>'Not Recommended'
            ],
            [
                'key' => 'fra',
                'overall'=>'For Approval'
            ],
            [
                'key' => 'frc',
                'overall'=>'For Approval with Conditions'
            ],
        ];

        foreach ($values as $value)
        {
            \App\Master\MasterOverallRecommendationPaf::create($value);
        }
    }
}
