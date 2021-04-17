<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_employees', function (Blueprint $table) {
            $table->bigIncrements('id');
             $table->string('name');
            $table->string('email');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')
                ->on('users')->onDelete('restrict');
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
        Schema::dropIfExists('add_employees');
    }
}
