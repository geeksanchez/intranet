<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCovidPositiveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('covid_positive', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('covid_id');
            $table->string('contact_type', 100);
            $table->text('description')->nullable();
            $table->text('symptoms')->nullable();
            $table->string('treatment', 100);
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
        Schema::dropIfExists('covid_positive');
    }
}
