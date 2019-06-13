<?php

use Illuminate\Database\Seeder;

class MasterSubStatusPaf extends Seeder
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
                'master_id_status'=>'1',
                'sub_request_status'=>'HR Pending',
                'description'=>'Escalate to HR for review and evaluation'
            ],
            [
                'master_id_status'=>'1',
                'sub_request_status'=>'Executive Pending',
                'description'=>'Escalate to Executive for approval'
            ],
            [
                'master_id_status'=>'1',
                'sub_request_status'=>'Manager Pending',
                'description'=>'Returned to Manager for reassessment'
            ],
            [
                'master_id_status'=>'2',
                'sub_request_status'=>'HR Denied',
                'description'=>'Request denied due to some circumstances'
            ],
            [
                'master_id_status'=>'2',
                'sub_request_status'=>'Executive Approved',
                'description'=>'The Executive has approved the paf request'
            ],
            [
                'master_id_status'=>'2',
                'sub_request_status'=>'Executive Denied',
                'description'=>'Request denied due to some circumstances'
            ],
            [
                'master_id_status'=>'2',
                'sub_request_status'=>'Closed Request',
                'description'=>'Manager closed the request'
            ],
        ];

        foreach ($values as $value)
        {
            \App\SubStatus::create($value);
        }
    }
}
