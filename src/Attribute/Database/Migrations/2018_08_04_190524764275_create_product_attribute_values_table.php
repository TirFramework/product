<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductAttributeValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        
        Schema::create('product_attribute_values', function (Blueprint $table) {
            $table->integer('product_attribute_id')->unsigned();
            $table->integer('attribute_value_id')->unsigned();
            
            $table->primary(['product_attribute_id', 'attribute_value_id'], 'product_attribute_id_attribute_value_id_primary');
            $table->foreign('product_attribute_id')->references('id')->on('product_attributes')->onDelete('cascade');
            $table->foreign('attribute_value_id')->references('id')->on('attribute_values')->onDelete('cascade');
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

        Schema::dropIfExists('product_attribute_values');

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
