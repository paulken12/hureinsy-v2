<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emp_contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('emp_basic_id');
            $table->string('telephone_num')->nullable();
            $table->string('mobile_num')->nullable();
            $table->string('other_mobile')->nullable();
            $table->integer('user_id'); // get the email from the user table
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
        Schema::dropIfExists('emp_contacts');
    }
}
