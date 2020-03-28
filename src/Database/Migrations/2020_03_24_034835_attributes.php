<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Attributes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::create('attribute_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('name');
            $table->integer('sort_order')->nullable();
            $table->softDeletes();
        });

        Schema::create('attribute_group_descriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('attribute_group_id');
            $table->foreign('attribute_group_id')->references('id')->on('attribute_groups')->onDelete('cascade');
            $table->integer('language_id')->default(1);
            $table->string('title')->nullable();
        });

        Schema::create('attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('name');
            $table->string('attribute_group_id');
            $table->integer('sort_order')->nullable();
            $table->softDeletes();
        });

        Schema::create('attribute_descriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('attribute_id');
            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
            $table->integer('language_id')->default(1);
            $table->string('title')->nullable();
        });

        Schema::create('attribute_product', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('attribute_id');
            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->integer('language_id')->default(1);
            $table->string('value')->nullable();
            $table->string('title')->nullable();
        });

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('attribute_groups');
        Schema::dropIfExists('attribute_group_descriptions');
        Schema::dropIfExists('attributes');
        Schema::dropIfExists('attribute_descriptions');
        Schema::dropIfExists('attribute_product');

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
