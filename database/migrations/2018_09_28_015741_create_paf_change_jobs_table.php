<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePafChangeJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paf_change_jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('request_id')->unsigned();
            $table->string('proposed_key_job_title')->nullable();
            $table->string('proposed_key_department')->nullable();
            $table->string('proposed_key_team')->nullable();
            $table->string('proposed_key_supervisor')->nullable();
            $table->string('proposed_key_project_assignment')->nullable();
            $table->string('proposed_remarks_hr')->nullable();
            $table->string('proposed_remarks_exec')->nullable();
            $table->timestamps();

            $table->foreign('request_id')
                ->references('id')
                ->on('paf_managements')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paf_change_jobs');
    }
}
