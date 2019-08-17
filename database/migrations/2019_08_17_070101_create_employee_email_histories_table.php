<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeEmailHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_email_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('employee_id');
            $table->string('email', 255);
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
        Schema::dropIfExists('employee_email_histories');
    }
}
