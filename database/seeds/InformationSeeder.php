<?php

use Illuminate\Database\Seeder;

class InformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $test = new \App\Helper\AppHelper();
        $test->importCsv('user.csv',\App\User::class);
        $test->importCsv('info.csv',\App\Personnel\Info\EmpBasic::class);
        $test->importCsv('add.csv',\App\Personnel\Info\EmpAddress::class);
        $test->importCsv('edu.csv',\App\Personnel\Info\EmpEducation::class);
        $test->importCsv('eme.csv',\App\Personnel\Info\EmpEmergencyContact::class);
        $test->importCsv('exp.csv',\App\Personnel\Info\EmpExperience::class);
        $test->importCsv('fam.csv',\App\Personnel\Info\EmpFamily::class);
        $test->importCsv('gov.csv',\App\Personnel\Info\EmpBenefit::class);
        $test->importCsv('med.csv',\App\Personnel\Info\EmpMedical::class);
        $test->importCsv('train.csv',\App\Personnel\Info\EmpTraining::class);
        $test->importCsv('cont.csv',\App\Personnel\Info\EmpContact::class);
        $test->importCsv('contract.csv',\App\Personnel\Info\EmpContract::class);
        $test->importCsv('team.csv',\App\Team::class);
        $test->importCsv('pos.csv',\App\Master\MasterJobTitle::class);
    }
}
