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
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->json('phones')->nullable();
            $table->string('lat', 45)->nullable();
            $table->string('long', 45)->nullable();
            $table->text('password')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('role', 100)->default('user');
            $table->text('logo')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->unsignedBigInteger('categories_id')->nullable();

            $table->index(["categories_id"], 'fk_users_categories1_idx');


            $table->foreign('categories_id', 'fk_users_categories1_idx')
                ->references('id')->on('categories')
                ->onDelete('cascade')
                ->onUpdate('no action');
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
