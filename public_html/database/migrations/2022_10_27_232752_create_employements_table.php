<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employements', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id')->nullable();
            $table->string('movement_type')->nullable();
            $table->string('area')->nullable();
            $table->string('office')->nullable();
            $table->string('job_level')->nullable();
            $table->string('position')->nullable();
            $table->string('type')->nullable();
            $table->string('note')->nullable();
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
        Schema::dropIfExists('employements');
    }
};
