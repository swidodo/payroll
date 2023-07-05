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
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->default('0');
            $table->string('name')->nullable();
            $table->string('identity_card')->default('0');
            $table->string('family_card')->default('0');
            $table->string('npwp_number')->nullable();
            $table->string('religion')->nullable();
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();

            $table->string('employee_id')->default('0');
            $table->integer('branch_id')->default('0');
            $table->integer('department_id')->default('0');
            $table->integer('designation_id')->default('0');
            //date of join
            $table->string('company_doj')->nullable();
            // date of end
            $table->string('company_doe')->nullable();
            $table->string('documents')->nullable();

            $table->string('account_holder_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_identifier_code')->nullable();
            $table->string('branch_location')->nullable();
            $table->string('tax_payer_id')->nullable();
            $table->string('salary_type')->nullable();
            $table->integer('salary')->nullable();
            $table->integer('net_salary')->nullable();
            $table->boolean('is_active')->default(1);
            $table->integer('created_by');
            $table->integer('level_approval')->nullable();

            $table->enum('leave_type', ['monthly', 'annual'])->nullable();
            $table->string('employee_type')->nullable();
            $table->enum('marital_status', ['single', 'married'])->nullable();
            $table->integer('total_leave')->default(0);
            $table->integer('total_leave_remaining')->nullable();
            $table->date('out_date')->nullable();
            $table->enum('status', ['pension', 'fired', 'active'])->default('active');
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
        Schema::dropIfExists('employees');
    }
};
