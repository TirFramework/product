<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('model');
            $table->integer('category_id')->nullable();
            $table->string('slug');
            $table->string('stockunit')->nullable();
            $table->string('location')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('stock_status_id')->nullable();
            $table->string('image')->nullable();
            $table->integer('shipping')->nullable();
            $table->decimal('price')->nullable();
            $table->integer('points')->nullable();
            $table->integer('tax_type_id')->nullable();
            $table->dateTime('date_available')->nullable();
            $table->decimal('weight')->nullable();
            $table->integer('weight_type_id')->nullable();
            $table->decimal('length')->nullable();
            $table->decimal('width')->nullable();
            $table->decimal('height')->nullable();
            $table->integer('size_type_id')->nullable();
            $table->boolean('subtract')->nullable();
            $table->integer('minimum')->nullable();
            $table->integer('sort_order')->nullable();
            $table->string('status')->default('published')->nullable();
            $table->integer('viewed')->default('0')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('product_descriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->integer('language_id')->default(1);
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('tag')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
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

        Schema::dropIfExists('products');
        Schema::dropIfExists('product_descriptions');

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }
}
