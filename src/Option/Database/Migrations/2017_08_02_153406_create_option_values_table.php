<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptionValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::create('option_values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('option_id')->unsigned()->index();
            $table->decimal('price', 18, 4)->unsigned()->nullable();
            $table->string('price_type', 10);
            $table->integer('position')->unsigned();
            $table->timestamps();

            $table->foreign('option_id')->references('id')->on('options')->onDelete('cascade');
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

        Schema::dropIfExists('option_values');

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }
}
