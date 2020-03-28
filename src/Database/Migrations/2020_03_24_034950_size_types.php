<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SizeTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::create('size_types', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->softDeletes();
        });

        Schema::create('size_type_descriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('size_type_id');
            $table->foreign('size_type_id')->references('id')->on('size_types')->onDelete('cascade');
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

        Schema::dropIfExists('size_types');
        Schema::dropIfExists('size_type_descriptions');

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
