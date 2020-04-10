<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptionValueTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::create('option_value_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('option_value_id')->unsigned();
            $table->string('locale');
            $table->string('label');

            $table->unique(['option_value_id', 'locale']);
            $table->foreign('option_value_id')->references('id')->on('option_values')->onDelete('cascade');
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

        Schema::dropIfExists('option_value_translations');

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
