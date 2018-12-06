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
            $table->integer('rq_id')->default(200);
            $table->integer('employee_company_id');
            $table->string('master_key_employment_status')->nullable();
            $table->string('master_key_change_of_contract')->nullable();
            $table->string('requested_by_company_id')->nullable();
            $table->string('approved_by_company_id')->nullable();
            $table->string('assessed_by_company_id')->nullable();
            $table->string('comfirmation_flag');
            $table->string('master_id_request_status');
            $table->string('master_id_sub_request_status');
            $table->string('remarks')->nullable();
            $table->date('date_effective');
            $table->date('contract_start')->nullable();
            $table->date('contract_end')->nullable();
            $table->date('resigned_date')->nullable();
            $table->string('application_flag');
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
