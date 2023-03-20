<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');

            $table->string('image', 255)->nullable()->charset('utf8');
            $table->text('text_title')->nullable()->charset('utf8');
            $table->text('text_desc')->nullable()->charset('utf8');
            $table->text('price1')->nullable()->charset('utf8');
            $table->text('price2')->nullable()->charset('utf8');
            $table->text('number')->nullable()->charset('utf8');
            $table->text('more_desc')->nullable()->charset('utf8');
            $table->text('howto')->nullable()->charset('utf8');
            
            $table->enum('type', ['1', '2'])->charset('utf8');

            $table->string('create_by', 100)->charset('utf8')->nullable();
            $table->string('update_by', 100)->charset('utf8')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
