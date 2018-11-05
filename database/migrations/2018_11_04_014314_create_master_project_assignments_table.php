<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterProjectAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_project_assignments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('project_title')->nullable();
            $table->string('project_desc')->nullable();
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
        Schema::dropIfExists('master_project_assignments');
    }
}
