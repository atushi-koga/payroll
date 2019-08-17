<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHourlyWageContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hourly_wage_contracts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('employee_id');
            $table->integer('hourly_wage_contract_history_id');
            $table->integer('hourly_wage');
            $table->integer('over_time_hourly_extra_wage');
            $table->integer('midnight_hourly_extra_wage');
            $table->date('apply_date');
            $table->timestamp('created_at');

            $table->foreign('employee_id')
                ->references('id')
                ->on('employees');
            $table->foreign('hourly_wage_contract_history_id')
                ->references('id')
                ->on('hourly_wage_contract_histories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hourly_wage_contracts');
    }
}
