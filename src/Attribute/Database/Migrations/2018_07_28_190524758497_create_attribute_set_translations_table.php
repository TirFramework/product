<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeSetTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::create('attribute_set_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('attribute_set_id')->unsigned();
            $table->string('locale');
            $table->string('name');
            
            $table->unique(['attribute_set_id', 'locale']);
            $table->foreign('attribute_set_id')->references('id')->on('attribute_sets')->onDelete('cascade');
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
        Schema::dropIfExists('attribute_set_translations');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');


    }
}
