<?php

use Illuminate\Database\Seeder;

class MasterJobTitle extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $test = new \App\Helper\AppHelper();
        $test->importCsv('pos.csv',\App\Master\MasterJobTitle::class);
    }
}
