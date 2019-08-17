<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpirationOfContractTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expiration_of_contract', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('employee_id');
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
        Schema::dropIfExists('expiration_of_contract');
    }
}