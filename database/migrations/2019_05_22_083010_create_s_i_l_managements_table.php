<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSILManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_i_l_managements', function (Blueprint $table) {
            $table->increments('id');
            $table->String('emp_id')->nullable();
            $table->String('man')->nullable();
            $table->String('add')->nullable();
            $table->boolean('update_flag')->nullable();
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
        Schema::dropIfExists('s_i_l_managements');
    }
}
