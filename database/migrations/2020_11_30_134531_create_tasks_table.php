<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->dateTime('expirationDate');
            $table->timestamp('dateOfCreation')->nullable();
            $table->timestamp('updateDate')->nullable();
            $table->string('priority');
            $table->string('status');
            $table->unsignedBigInteger('creator_id');
            $table->unsignedBigInteger('responsible_id')->nullable();

            $table->foreign('creator_id')->references('id')->on('users');
            $table->foreign('responsible_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
