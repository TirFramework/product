<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Options extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::create('options', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('name');
            $table->string('type');
            $table->integer('sort_order')->nullable();
            $table->softDeletes();
        });

        Schema::create('option_descriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('option_id');
            $table->foreign('option_id')->references('id')->on('options')->onDelete('cascade');
            $table->integer('language_id')->default(1);
            $table->string('title')->nullable();
        });

        Schema::create('option_values', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('option_id');
            $table->foreign('option_id')->references('id')->on('options')->onDelete('cascade');
            $table->string('image')->default(1);
            $table->string('name')->nullable();
            $table->integer('sort_order')->nullable();
        });

        Schema::create('option_value_descriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('option_value_id');
            $table->unsignedInteger('option_id');
            $table->foreign('option_id')->references('id')->on('options')->onDelete('cascade');
            $table->integer('language_id')->default(1);
            $table->string('title')->nullable();
        });

        Schema::create('product_options', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedInteger('option_id');
            $table->foreign('option_id')->references('id')->on('options')->onDelete('cascade');
            $table->string('value')->nullable();
            $table->boolean('required')->nullable();
        });

        Schema::create('product_option_values', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedInteger('option_id');
            $table->foreign('option_id')->references('id')->on('options')->onDelete('cascade');
            $table->unsignedInteger('product_option_id');
            $table->foreign('product_option_id')->references('id')->on('product_options')->onDelete('cascade');
            $table->unsignedInteger('option_value_id');
            $table->foreign('option_value_id')->references('id')->on('option_values')->onDelete('cascade');
            $table->integer('quantity')->nullable();
            $table->boolean('subtract')->nullable();
            $table->decimal('price')->nullable();
            $table->integer('points')->nullable();
            $table->decimal('weight')->nullable();
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
          Schema::dropIfExists('options');
          Schema::dropIfExists('option_descriptions');
          Schema::dropIfExists('option_values');
          Schema::dropIfExists('option_value_descriptions');
          Schema::dropIfExists('product_options');
          Schema::dropIfExists('product_option_values');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
