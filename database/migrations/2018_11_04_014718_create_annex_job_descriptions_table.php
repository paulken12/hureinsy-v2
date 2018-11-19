<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnexJobDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annex_job_descriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('job_description_id')->nullable();
            $table->string('department_key')->nullable();
            $table->string('project_id')->nullable();
            $table->string('reporting_to')->nullable();
            $table->string('team_id')->nullable();
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
        Schema::dropIfExists('annex_job_descriptions');
    }
}
