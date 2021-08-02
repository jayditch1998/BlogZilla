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
            $table->string('firstName');
            $table->string('lastName');
            $table->string('middleName');
            $table->string('email')->unique();
            $table->integer('mobile');
            $table->string('status');
            // $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('profile');
            $table->tinyInteger('is_admin');
            $table->tinyInteger('is_author');
            $table->dateTime('lastLogin');
            $table->dateTime('updatedAt')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            // $table->rememberToken();
            $table->timestamp('createdAt');
            // $table->timestamp('');
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
