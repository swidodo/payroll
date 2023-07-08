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
        Schema::create('history_leaves', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('employee_id')->nullable();
            $table->integer('leave_type_id')->nullable();
            $table->date('applied_on')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('total_leave_days')->nullable();
            $table->string('leave_reason')->nullable();
            $table->string('attachment_request_path')->nullable();
            $table->string('remark')->nullable()->nullable();
            $table->string('status')->nullable();
            $table->string('rejected_reason')->nullable();
            $table->string('attachment_reject')->nullable();
            $table->integer('created_by')->nullable();
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
        Schema::dropIfExists('overtimes');
    }
};
