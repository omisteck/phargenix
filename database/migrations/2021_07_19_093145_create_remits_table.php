<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->string('POS');
            $table->string('Cash');
            $table->string('Transfer');
            $table->string('Total');
            $table->string('Todelete');
            $table->string('Remitted');
            $table->string('Balance');
            $table->string('Date');
            $table->enum('old', ['true','false'])->default('false');
            $table->foreignId('approve_by')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('remits');
    }
}
