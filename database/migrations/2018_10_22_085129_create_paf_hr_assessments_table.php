<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePafHrAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paf_hr_assessments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('request_id')->unsigned();
            $table->string('proficiency test')->nullable();
            $table->string('other_remarks')->nullable();
            $table->string('current_bonus_allowance')->nullable();
            $table->string('overall_recommendation')->nullable();
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
        Schema::dropIfExists('paf_hr_assessments');
    }
}
