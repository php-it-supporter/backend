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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('role')->default('r4');

            $table->string('isActive')->default(false);
            $table->string('isDelete')->default(false);

            $table->string('fullName')->nullable();
            $table->string('age')->nullable();
            $table->string('avatar')->nullable();
            $table->string('phone')->nullable();

            $table->string('fund')->nullable();

            $table->timestamps();

            $table->unsignedBigInteger('major')->nullable();
            $table->foreign('major')->references('id')->on('majors')->nullOnDelete();

            $table->unsignedBigInteger('department')->nullable();
            $table->foreign('department')->references('id')->on('departments')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
