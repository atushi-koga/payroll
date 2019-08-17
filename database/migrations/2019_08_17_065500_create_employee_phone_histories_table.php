<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeePhoneHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_phone_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('employee_id');
            $table->string('phone', 13);
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
        Schema::dropIfExists('employee_phone_histories');
    }
}
