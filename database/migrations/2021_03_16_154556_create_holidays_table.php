<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHolidaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('holidays', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('leave_type');
            $table->string('leave_cause');
        $table->DateTime('leave_start')->format('d/m/y  H:i A');
        $table->DateTime('leave_end')->format('d/m/y  H:i A');
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
        Schema::dropIfExists('holidays');
    }
}
