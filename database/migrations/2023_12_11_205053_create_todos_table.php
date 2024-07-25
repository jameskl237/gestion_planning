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
        Schema::create('todos', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('date_debut');
            $table->string('date_fin');
            $table->string('heure_debut');
            $table->string('heure_fin');
            $table->string('jour')->nullable();
            $table->timestamps();

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

        });

        Schema::create('todo_users', function (Blueprint $table){
            $table->id()->autoIncrement();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('todo_id')->constrained('todos')->onDelete('cascade');
            $table->enum('is_view', ['0','1'])->default('0');
            $table->timestamps();

        });

        Schema::create('todo_plannings', function (Blueprint $table){
            $table->id()->autoIncrement();
            $table->foreignId('planning_id')->constrained('plannings')->onDelete('cascade');
            $table->foreignId('todo_id')->constrained('todos')->onDelete('cascade');
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
        Schema::dropIfExists('todos');
    }
};
