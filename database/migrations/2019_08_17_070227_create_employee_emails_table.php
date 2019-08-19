<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_emails', function (Blueprint $table) {
            $table->bigInteger('employee_id');
            $table->bigInteger('employee_email_id');
            $table->string('email', 255);
            $table->timestamp('created_at');

            $table->primary('employee_id');
            $table->foreign('employee_id')
                ->references('id')
                ->on('employees');
            $table->foreign('employee_email_id')
                ->references('employee_email_id')
                ->on('employee_email_histories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_emails');
    }
}
