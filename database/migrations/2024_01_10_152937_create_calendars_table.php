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
        Schema::create('calendars', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('start_year');
            $table->string('start_month');
            $table->string('start_day');
            $table->string('start_hour');
            $table->string('start_minute');
            $table->string('end_year');
            $table->string('end_month');
            $table->string('end_day');
            $table->string('end_hour');
            $table->string('end_minute');
            $table->string('colors');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
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
        Schema::dropIfExists('calendars');
    }
};
