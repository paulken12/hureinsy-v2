<?php

use Illuminate\Database\Seeder;

class MasterStatusPaf extends Seeder
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
                'request_status'=>'Open'
            ],
            [
                'request_status'=>'Completed'
            ],

        ];

        foreach ($values as $value)
        {
            \App\Status::create($value);
        }
    }
}
