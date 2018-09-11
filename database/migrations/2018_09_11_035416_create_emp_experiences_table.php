<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emp_experiences', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('emp_basic_id');
            $table->string('master_job_title_key');
            $table->string('company_name')->nullable();
            $table->string('company_address')->nullable();
            $table->date('date_from')->nullable();
            $table->date('date_to')->nullable();
            $table->string('industry')->nullable();
            $table->integer('salary')->nullable();
            $table->string('responsibilities')->nullable();
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
        Schema::dropIfExists('emp_experiences');
    }
}
