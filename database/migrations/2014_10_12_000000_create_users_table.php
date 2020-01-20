<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Eloquent\SoftDeletes;

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
            $table->bigIncrements('id');
            $table->string('google_id')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('timezone')->default('America/Toronto');
            $table->string('state')->default('Ontario');
            $table->string('country')->default('Canada');
            $table->unsignedBigInteger('current_organization')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->default("");
            $table->string('api_token', 80)->unique()->nullable()->default(null);
            $table->boolean('is_admin')->default(false);
            $table->string('picture')->nullable();

            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
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
