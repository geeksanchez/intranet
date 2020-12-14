<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCovidFollowTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('covid_follow', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('covid_id');
            $table->string('disability', 100);
            $table->date('disability_date');
            $table->date('return_date')->nullable();
            $table->text('diagnosis')->nullable();
            $table->text('notes')->nullable();
            $table->bigInteger('user_id');
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
        Schema::dropIfExists('covid_follow');
    }
}
