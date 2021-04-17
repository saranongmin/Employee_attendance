<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
             $table->string('name')->nullable();
            $table->string('date_joining')->nullable();
            $table->string('position')->nullable();
            $table->string('department')->nullable();
            $table->string('location')->nullable();
            $table->string('date_termination')->nullable();
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
        Schema::dropIfExists('employee_profiles');
    }
}
