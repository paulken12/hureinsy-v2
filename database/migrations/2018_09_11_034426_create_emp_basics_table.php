<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpBasicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emp_basics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('company_id')->unique();
            $table->string('master_extension_key')->nullable();
            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('master_gender_key')->nullable();
            $table->string('master_civil_status_key')->nullable();
            $table->string('master_citizenship_key')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('slug')->unique();
            $table->integer('reporting_to');
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
        Schema::dropIfExists('emp_basics');
    }
}
