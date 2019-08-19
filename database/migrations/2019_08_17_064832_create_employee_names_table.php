<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeNamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_names', function (Blueprint $table) {
            $table->bigInteger('employee_id');
            $table->bigInteger('employee_name_id');
            $table->string('name', 40);
            $table->timestamp('created_at');

            $table->primary('employee_id');
            $table->foreign('employee_id')
                ->references('id')
                ->on('employees');
            $table->foreign('employee_name_id')
                ->references('employee_name_id')
                ->on('employee_name_histories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_names');
    }
}
