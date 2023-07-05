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
        Schema::create('all_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('request_id')->nullable();
            $table->string('request_no')->nullable();
            $table->string('request_for')->nullable();
            $table->string('request_by')->nullable();
            $table->string('request_type')->nullable();
            $table->date('req_date')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('all_requests');
    }
};
