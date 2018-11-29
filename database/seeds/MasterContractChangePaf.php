<?php

use Illuminate\Database\Seeder;

class MasterContractChangePaf extends Seeder
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
                'key' => 'ren',
                'change_type' => 'Renewal',
            ],
            [
                'key' => 'eoc',
                'change_type' => 'End of contract',
            ],
            [
                'key' => 'tra',
                'change_type' => 'Transfer',
            ],
            [
                'key' => 'reh',
                'change_type' => 'Rehire',
            ],
            [
                'key' => 'ttp',
                'change_type' => 'Trainee to project',
            ],
            [
                'key' => 'reg',
                'change_type' => 'Regularization',
            ],
            [
                'key' => 'eop',
                'change_type' => 'End of probationary period',
            ],
            [
                'key' => 'sai',
                'change_type' => 'Salary increase',
            ],
            [
                'key' => 'sfr',
                'change_type' => 'Employment separation for rehire',
            ],
            [
                'key' => 'snr',
                'change_type' => 'Employment separation not for rehire',
            ],
            [
                'key' => 'ptr',
                'change_type' => 'Project to Regular',
            ],
            [
                'key' => 'pro',
                'change_type' => 'Promotion',
            ],
            [
                'key' => 'dem',
                'change_type' => 'Demotion',
            ],

        ];

        foreach ($values as $value)
        {
            \App\Master\MasterContractChangePaf::create($value);
        }
    }
}
