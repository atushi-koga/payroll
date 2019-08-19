<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeePhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_phones', function (Blueprint $table) {
            $table->bigInteger('employee_id');
            $table->bigInteger('employee_phone_id');
            $table->string('phone', 13);
            $table->timestamp('created_at');

            $table->primary('employee_id');
            $table->foreign('employee_id')
                ->references('id')
                ->on('employees');
            $table->foreign('employee_phone_id')
                ->references('employee_phone_id')
                ->on('employee_phone_histories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_phones');
    }
}
