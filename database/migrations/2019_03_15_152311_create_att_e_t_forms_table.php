<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttETFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('att_e_t_forms', function (Blueprint $table) {
            $table->increments('id');
            $table->String('employee_id');
            $table->String('reporting_to')->nullable();
            $table->date('date')->nullable();
            $table->time('time_out')->nullable();
            $table->time('new_time_out')->nullable();
            $table->String('reason')->nullable();
            $table->String('status');
            $table->String('confirmed');
            $table->String('remarks');
            $table->String('applied');
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
        Schema::dropIfExists('att_e_t_forms');
    }
}
