<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::create('attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('attribute_set_id')->unsigned()->index();
            $table->boolean('is_filterable');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('position')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set Null');
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
        Schema::dropIfExists('attributes');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }
}
