<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer_reference_no')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('project_title')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('contact_num')->nullable();
            $table->string('master_company_key')->nullable();
            $table->date('project_start')->nullable();
            $table->date('project_end')->nullable();
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
        Schema::dropIfExists('projects');
    }
}
