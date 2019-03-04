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
            $table->string('time_in');
            $table->boolean('is_late');
            $table->string('time_out');
            $table->boolean('is_under_time');
            $table->double('total_hours');
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
