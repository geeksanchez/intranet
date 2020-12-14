<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePqrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pqrs', function (Blueprint $table) {
            $table->id();
            $table->string('doctype', 2);
            $table->string('document', 50);
            $table->string('username', 255);
            $table->string('email', 255);
            $table->string('phone', 50)->nullable();
            $table->string('cellphone', 50);
            $table->string('insurer', 50);
            $table->string('branch', 50);
            $table->string('service', 50);
            $table->string('classification', 50);
            $table->string('pqrstype', 50);
            $table->text('notes')->nullable();
            $table->string('filledby', 50);
            $table->string('legal', 10);
            $table->unsignedInteger('active');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->text('feedback')->nullable();
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
        Schema::dropIfExists('pqrs');
    }
}
