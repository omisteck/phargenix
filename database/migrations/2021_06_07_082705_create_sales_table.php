<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('invoice_number');
            $table->json('data');
            $table->string('shift');
            $table->integer('qty');
            $table->string('total');
            $table->string('invoice_discount');
            $table->string('invoice_paid');
            $table->string('invoice_total');
            $table->string('mode');
            $table->foreignId('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->enum('settlement', ['true','false'])->default('false');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
