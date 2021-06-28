<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number');
            $table->json('product');
            $table->foreignId('supplier')->references('id')->on('suppliers')->onDelete('cascade');
            $table->foreignId('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->integer('qty');
            $table->integer('unit');
            $table->integer('total');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->enum('settlement', ['true','false'])->default('false');
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
        Schema::dropIfExists('purchases');
    }
}
