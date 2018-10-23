<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePafManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paf_managements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_company_id');
            $table->string('master_key_employment_status');
            $table->string('requested_by_company_id');
            $table->string('approved_by_company_id');
            $table->string('assessed_by_company_id');
            $table->string('hr_assessment_id');
            $table->string('comfirmation_flag');
            $table->string('master_id_request_status');
            $table->string('master_id_sub_request_status');
            $table->string('remarks')->nullable();
            $table->date('date_effective');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paf_managements');
    }
}
