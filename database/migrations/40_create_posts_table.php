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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('type')->nullable()->default('0');
            $table->text('content');
            $table->string('image')->nullable();
            $table->string('isActive')->default(true);

            $table->timestamps();

            $table->unsignedBigInteger('author')->nullable();
            $table->foreign('author')->references('id')->on('users')->cascadeOnDelete();

            $table->unsignedBigInteger('category')->nullable();
            $table->foreign('category')->references('id')->on('categories')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
