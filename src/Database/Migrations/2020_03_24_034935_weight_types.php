<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class WeightTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::create('weight_types', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->softDeletes();
        });

        Schema::create('weight_type_descriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('weight_type_id');
            $table->foreign('weight_type_id')->references('id')->on('weight_types')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->integer('language_id')->default(1);
            $table->string('title')->nullable();
            $table->string('unit')->nullable();
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

        Schema::dropIfExists('weight_types');
        Schema::dropIfExists('weight_type_descriptions');

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
