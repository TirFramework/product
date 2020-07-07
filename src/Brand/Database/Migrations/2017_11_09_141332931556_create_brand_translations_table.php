<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::create('brand_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('brand_id')->unsigned();
            $table->string('locale');
            $table->string('name');
            $table->string('description')->nullable();

            $table->unique(['brand_id', 'locale']);
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
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
        Schema::dropIfExists('brand_translations');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }
}
