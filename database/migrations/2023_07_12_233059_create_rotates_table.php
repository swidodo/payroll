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
        Schema::create('rotates', function (Blueprint $table) {
            $table->id();
            $table->integer('rotate_id');
            $table->integer('employee_id');
            $table->integer('company_id');
            $table->integer('branch_id');
            $table->integer('from_department_id');
            $table->integer('to_department_id');
            $table->string('rotate_name');
            $table->string('employee_name');
            $table->string('branch_name');
            $table->string('employee_name');
            $table->integer('create_by');
            $table->rotate_date('date');
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
        Schema::dropIfExists('rotates');
    }
};
