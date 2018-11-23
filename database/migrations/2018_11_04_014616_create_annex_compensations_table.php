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
            $table->string('probationary_rate')->nullable();
            $table->string('gross_salary')->nullable();
            $table->string('basic_salary')->nullable();
            $table->string('other_bonus_allowance')->nullable();
            $table->string('other_benefits')->nullable();
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
        Schema::dropIfExists('annex_compensations');
    }
}
