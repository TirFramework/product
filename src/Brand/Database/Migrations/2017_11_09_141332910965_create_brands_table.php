<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::create('brands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->string('logo')->nullable();
            $table->integer('position')->unsigned()->nullable();
            $table->boolean('is_active');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set Null');
            
        });

        Schema::create('brand_category', function (Blueprint $table) {
            $table->integer('category_id')->unsigned()->index();
            $table->bigInteger('brand_id')->unsigned()->index();

            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

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
        Schema::dropIfExists('brands');
        Schema::dropIfExists('brand_category');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }
}
