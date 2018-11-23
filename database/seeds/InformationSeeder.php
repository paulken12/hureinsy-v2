<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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
        $test->importCsv('new_contract.csv',\App\Personnel\Info\Contract::class);
        $test->importCsv('team.csv',\App\Team::class);
        $test->importCsv('pos.csv',\App\Master\MasterJobTitle::class);
        $test->importCsv('dept.csv',\App\Master\MasterDepartment::class);
        $test->importCsv('annex_job_desc.csv',\App\Annex\JobDescription\AnnexJobDescription::class);
        $test->importCsv('annex_sched.csv',\App\Annex\Schedule\AnnexSchedule::class);
        $test->importCsv('annex_compe.csv',\App\Annex\Compensation\AnnexCompensation::class);
        $test->importCsv('job_desc.csv',\App\Contract\Job::class);
        $test->importCsv('assign.csv',\App\Contract\Project::class);
        $test->importCsv('assign.csv',\App\Master\MasterProjectAssignment::class);

        Schema::disableForeignKeyConstraints();

        $test = new \App\Helper\AppHelper();

        $file = base_path().'/database/seeds/csv/job_assign.csv';

        $customerArr = $test->csvToArray($file);

        DB::table('job_project')->insert($customerArr);

        Schema::enableForeignKeyConstraints();
//        $test->importCsv('user.csv',\App\User::class);
//        $test->importCsv('info.csv',\App\Personnel\Info\EmpBasic::class);
//        $test->importCsv('add.csv',\App\Personnel\Info\EmpAddress::class);
//        $test->importCsv('edu.csv',\App\Personnel\Info\EmpEducation::class);
//        $test->importCsv('eme.csv',\App\Personnel\Info\EmpEmergencyContact::class);
//        $test->importCsv('exp.csv',\App\Personnel\Info\EmpExperience::class);
//        $test->importCsv('fam.csv',\App\Personnel\Info\EmpFamily::class);
//        $test->importCsv('gov.csv',\App\Personnel\Info\EmpBenefit::class);
//        $test->importCsv('med.csv',\App\Personnel\Info\EmpMedical::class);
//        $test->importCsv('train.csv',\App\Personnel\Info\EmpTraining::class);
//        $test->importCsv('skill.csv',\App\Personnel\Info\EmpSkill::class);
//        $test->importCsv('contract.csv',\App\Personnel\Info\EmpContract::class);
//        $test->importCsv('new_contract.csv',\App\Personnel\Info\Contract::class);
//        $test->importCsv('team.csv',\App\Team::class);
//        $test->importCsv('pos.csv',\App\Master\MasterJobTitle::class);
//        $test->importCsv('dept.csv',\App\Master\MasterDepartment::class);
//        $test->importCsv('job_desc.csv',\App\Annex\JobDescription\AnnexJobDescription::class);
//        $test->importCsv('job_desc.csv',\App\Contract\Job::class);
//        $test->importCsv('assign.csv',\App\Contract\Project::class);
//          $test->importCsv('assign.csv',\App\Master\MasterProjectAssignment::class);

//        Schema::disableForeignKeyConstraints();
//
//        $test = new \App\Helper\AppHelper();
//
//        $file = base_path().'/database/seeds/csv/job_assign.csv';
//
//        $customerArr = $test->csvToArray($file);
//
//        DB::table('job_project')->insert($customerArr);
//
//        Schema::enableForeignKeyConstraints();
    }
}
