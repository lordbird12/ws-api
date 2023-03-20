<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');

            $table->string('username', 50)->unique()->charset('utf8');
            $table->string('password', 100)->charset('utf8')->nullable();
            $table->string('name', 255)->charset('utf8');
            $table->string('email', 100)->charset('utf8');
            $table->string('phone', 100)->charset('utf8');
            $table->string('image', 255)->nullable()->charset('utf8');
            $table->enum('status', ['Yes', 'No', 'Request'])->charset('utf8')->default('Yes');
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
        Schema::dropIfExists('users');
    }
}
