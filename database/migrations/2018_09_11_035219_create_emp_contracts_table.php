<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emp_contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('emp_basic_id');
            $table->string('company_email')->nullable();
            $table->string('master_company_key');
            $table->integer('master_job_title_id')->nullable();
            $table->string('master_shift_key')->nullable();
            $table->date('contract_start')->nullable();
            $table->date('contract_end')->nullable();
            $table->string('employment_status');
            $table->date('resigned_date')->nullable();
            $table->string('master_department_key')->nullable();
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
        Schema::dropIfExists('emp_contracts');
    }
}
