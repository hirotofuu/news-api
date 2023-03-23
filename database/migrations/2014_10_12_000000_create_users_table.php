<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string("google_id")->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('avatar_image')->default('avatar/no-image-icon-23479.png');
            $table->string('profile')->default('')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('folls');
        Schema::dropIfExists('truths');
        Schema::dropIfExists('fakes');
        Schema::dropIfExists('goods');
        Schema::dropIfExists('articles');
        Schema::dropIfExists('comments');
    }
};
