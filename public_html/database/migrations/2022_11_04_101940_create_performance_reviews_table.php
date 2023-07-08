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
        Schema::create('performance_reviews', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id')->nullable();
            $table->integer('knowledge')->nullable();
            $table->integer('skill')->nullable();
            $table->integer('accuracy')->nullable();
            $table->integer('quality')->nullable();
            $table->integer('care')->nullable();
            $table->integer('reliability')->nullable();
            $table->integer('working_method')->nullable();
            $table->integer('flexibility')->nullable();
            $table->integer('initiative')->nullable();
            $table->integer('cooperation')->nullable();
            $table->integer('attendance')->nullable();
            $table->integer('organizational_commitment')->nullable();
            $table->decimal('kpi_total_score')->nullable();
            $table->date('review_date')->nullable();
            $table->integer('created_by')->nullable();
            $table->string('notes')->nullable();
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
        Schema::dropIfExists('performance_reviews');
    }
};
