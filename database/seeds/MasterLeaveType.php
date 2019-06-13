<?php

use Illuminate\Database\Seeder;

class MasterLeaveType extends Seeder
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
                'key'=>'mla',
                'type'=>'Maternity Leave (Normal/Caesarian Delivery)'
            ],
            [
                'key'=>'mlb',
                'type'=>'Maternity Leave (miscarriage/emergency termination)'
            ],
            [
                'key'=>'pla',
                'type'=>'Paternity Leave (Normal/Caesarian Delivery)'
            ],
            [
                'key'=>'plb',
                'type'=>'Paternity Leave (Miscarriage/Emergency Termination)'
            ],
            [
                'key'=>'bla',
                'type'=>'Bereavement Leave'
            ],
            [
                'key'=>'blb',
                'type'=>'Birthday Leave'
            ],
            [
                'key'=>'spl',
                'type'=>'Solo Parent Leave'
            ],
            [
                'key'=>'slw',
                'type'=>'Special Leave for Women'
            ],
            [
                'key'=>'vvl',
                'type'=>'Victims of Violence Against Women and their Children'
            ],
            [
                'key'=>'vla',
                'type'=>'Vacation Leave'
            ],
            [
                'key'=>'plc',
                'type'=>'Personal Leave'
            ],
            [
                'key'=>'sla',
                'type'=>'Sick Leave'
            ],
            [
                'key'=>'ela',
                'type'=>'Emergency Leave'
            ],
        ];
        
        foreach ($values as $value)
        {
            \App\Master\MasterLeaveType::create($value);
        }
    }
}
