<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHourlyWageContractHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hourly_wage_contract_histories', function (Blueprint $table) {
            $table->bigIncrements('hourly_wage_id');
            $table->bigInteger('employee_id');
            $table->integer('hourly_wage');
            $table->integer('over_time_hourly_extra_wage');
            $table->integer('midnight_hourly_extra_wage');
            $table->date('apply_date');
            $table->timestamp('created_at');

            $table->foreign('employee_id')
                ->references('id')
                ->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hourly_wage_contract_histories');
    }
}
