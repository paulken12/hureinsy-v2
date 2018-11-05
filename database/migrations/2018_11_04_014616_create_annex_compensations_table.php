<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnexCompensationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annex_compensations', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('is_probationary')->default(false);
            $table->double('probationary_rate')->nullable();
            $table->double('gross_salary')->nullable();
            $table->double('basic_salary')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('annex_compensations');
    }
}
