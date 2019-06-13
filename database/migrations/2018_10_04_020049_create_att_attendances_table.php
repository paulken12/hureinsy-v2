<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('att_attendances', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dtr_id');
            $table->integer('emp_basic_id');
            $table->date('date');
            $table->string('required_time_in');
            $table->string('time_in')->nullable();
            $table->boolean('is_late')->nullable();
            $table->string('required_time_out');
            $table->string('time_out')->nullable();
            $table->boolean('is_under_time')->nullable();
            $table->double('total_hours')->nullable();
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
        Schema::dropIfExists('att_attendances');
    }
}
