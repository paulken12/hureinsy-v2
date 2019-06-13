<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        $this->call(UsersTableSeeder::class);
//        $test = new \App\Helper\AppHelper();
//        $test->importCsv('perm.csv',\App\Permission::class);
//        $test->importCsv('role.csv',\App\Role::class);

        $this->call(LaratrustSeeder::class);
        $this->call(InformationSeeder::class);
        $this->call(MasterAddressType::class);
        $this->call(MasterBloodType::class);
        $this->call(MasterCitizenship::class);
        $this->call(MasterCivilStatus::class);
        $this->call(MasterDepartment::class);
        $this->call(MasterEducationalType::class);
        $this->call(MasterEmployeeStatus::class);
        $this->call(MasterFamilyType::class);
        $this->call(MasterGender::class);
        $this->call(MasterJobTitle::class);
        $this->call(MasterNameExtension::class);
        $this->call(MasterTeam::class);
        $this->call(MasterCompany::class);
        $this->call(RoleUser::class);
        //Paf        
        $this->call(MasterContractChangePaf::class);
        $this->call(MasterStatusPaf::class);
        $this->call(MasterSubStatusPaf::class);
        $this->call(MasterScheduleTypePaf::class);
        $this->call(MasterBehaviouralAssessmentPaf::class);
        $this->call(MasterOverallRecommendationPaf::class);
        $this->call(MasterPerformanceEvaluationPaf::class);
        $this->call(MasterProficiencyTestPaf::class);
        //AMS
        $this->call(MasterLeaveType::class);

//
//        $this->call(MasterAddressType::class);
//        $this->call(MasterBloodType::class);
//        $this->call(MasterCitizenship::class);
//        $this->call(MasterCivilStatus::class);
//        $this->call(MasterDepartment::class);
//        $this->call(MasterEducationalType::class);
//        $this->call(MasterEmployeeStatus::class);
//        $this->call(MasterFamilyType::class);
//        $this->call(MasterGender::class);
//        $this->call(MasterJobTitle::class);
//        $this->call(MasterNameExtension::class);
//        $this->call(MasterTeam::class);
//        $this->call(MasterCompany::class);
//        $this->call(RoleUser::class);
//        Schema::disableForeignKeyConstraints();
//
//        $this->call(PermissionRole::class);
//        $this->call(PermissionUser::class);
//        $this->call(RoleUser::class);
//
//        Schema::enableForeignKeyConstraints();
    }
}
