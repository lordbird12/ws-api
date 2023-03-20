<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');

            $table->string('phone_1', 255)->nullable()->charset('utf8');
            $table->string('phone_2', 255)->nullable()->charset('utf8');
            $table->string('email_1', 255)->nullable()->charset('utf8');
            $table->string('email_2', 255)->nullable()->charset('utf8');
            $table->text('address')->nullable()->charset('utf8');
            $table->text('facebook')->nullable()->charset('utf8');
            $table->text('line')->nullable()->charset('utf8');
            $table->text('ig')->nullable()->charset('utf8');
            $table->text('youtube')->nullable()->charset('utf8');
            $table->text('script')->nullable()->charset('utf8');
            $table->text('map')->nullable()->charset('utf8');
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
        Schema::dropIfExists('contacts');
    }
}
