<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $test = new \App\Helper\AppHelper();

        $file = base_path().'/database/seeds/csv/perm_user.csv';

        $customerArr = $test->csvToArray($file);

        DB::table('permission_user')->insert($customerArr);

    }
}
