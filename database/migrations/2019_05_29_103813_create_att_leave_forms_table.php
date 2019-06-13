<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttLeaveFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('att_leave_forms', function (Blueprint $table) {
            $table->increments('id');
            $table->String('employee_id');
            $table->String('validated_by')->nullable();
            $table->String('approved_by')->nullable();
            $table->String('leave_type')->nullable();
            $table->String('reason')->nullable();
            $table->String('date_start')->nullable();
            $table->String('date_end')->nullable();
            $table->String('total_leaves')->nullable();
            $table->String('status')->nullable();
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
        Schema::dropIfExists('att_leave_forms');
    }
}
