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
        Schema::create('timesheets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('employee_id')->nullable();
            $table->string('project_stage')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->time('duration')->nullable();
            $table->string('task_or_project')->nullable();
            $table->string('activity')->nullable();
            $table->string('client_company')->nullable();
            $table->string('label_project')->nullable();
            $table->string('file_attachment')->nullable();
            $table->string('remark')->nullable();
            $table->string('support')->nullable();
            $table->string('status')->nullable();
            $table->string('rejected_reason')->nullable();
            $table->string('attachment_reject')->nullable();
            $table->integer('created_by')->default(0);
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
        Schema::dropIfExists('timesheets');
    }
};
