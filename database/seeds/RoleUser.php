<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RoleUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $test = new \App\Helper\AppHelper();

        $file = base_path().'/database/seeds/csv/role_user.csv';

        $customerArr = $test->csvToArray($file);

        Schema::disableForeignKeyConstraints();
        DB::table('role_user')->truncate();
        DB::table('role_user')->insert($customerArr);
        Schema::enableForeignKeyConstraints();
    }
}
