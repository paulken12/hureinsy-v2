<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttOTFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('att_o_t_forms', function (Blueprint $table) {
            $table->increments('id');
            $table->String('employee_id');
            $table->String('reporting_to')->nullable();
            $table->date('date')->nullable();
            $table->String('type')->nullable();
            $table->String('regular_time')->nullable();
            $table->time('ot_start')->nullable();
            $table->time('ot_end')->nullable();
            $table->String('hours')->nullable();
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
        Schema::dropIfExists('att_o_t_forms');
    }
}
