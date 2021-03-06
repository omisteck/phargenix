<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReconcilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reconciles', function (Blueprint $table) {
            $table->id();
            $table->json('data');
            $table->integer('qty');
            $table->string('remark');
            $table->enum('type', ['in', 'out']);
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->enum('old', ['true','false'])->default('false');
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
        Schema::dropIfExists('reconciles');
    }
}
