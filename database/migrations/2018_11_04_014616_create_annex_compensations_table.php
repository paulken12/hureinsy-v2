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
            $table->string('job_grade')->nullable();
            $table->double('probationary_rate')->nullable();
            $table->double('gross_salary')->nullable();
            $table->double('basic_salary')->nullable();
            $table->double('rice_allowance')->nullable();
            $table->double('clothing_allowance')->nullable();
            $table->double('medical_benefit')->nullable();
            $table->double('productivity_incentive')->nullable();
            $table->string('other_bonus_allowance')->nullable();
            $table->string('other_benefits')->nullable();
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
