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
                'change_type' => 'renewal',
            ],
            [
                'key' => 'eoc',
                'change_type' => 'end of contract',
            ],
            [
                'key' => 'tra',
                'change_type' => 'transfer',
            ],
            [
                'key' => 'reh',
                'change_type' => 'rehire',
            ],
            [
                'key' => 'ttp',
                'change_type' => 'trainee to project',
            ],
            [
                'key' => 'reg',
                'change_type' => 'regularization',
            ],
            [
                'key' => 'eop',
                'change_type' => 'end of probationary period',
            ],
            [
                'key' => 'sai',
                'change_type' => 'salary increase',
            ],
            [
                'key' => 'sfr',
                'change_type' => 'separation for rehire',
            ],
            [
                'key' => 'snr',
                'change_type' => 'separation not for rehire',
            ],

        ];

        foreach ($values as $value)
        {
            \App\Master\MasterContractChangePaf::create($value);
        }
    }
}
