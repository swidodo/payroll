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
        Schema::create('pay_slips', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('employee_id');
            $table->string('pdf_filename');
            $table->integer('net_payble');
            $table->string('salary_month');
            $table->integer('status');
            $table->text('basic_salary');
            $table->integer('salary');
            $table->text('allowance');
            $table->text('reimburst');
            $table->text('cash_in_advance');
            $table->text('loan');
            $table->text('denda');
            $table->text('bpjs_kesehatan')->nullable();
            $table->text('pph21')->nullable();
            $table->text('overtime');
            $table->integer('created_by');
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
        Schema::dropIfExists('pay_slips');
    }
};
