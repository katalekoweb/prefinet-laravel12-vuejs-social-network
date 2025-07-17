<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->uuid()->nullable();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('username', 25)->unique();
            $table->string('avatar')->nullable();
            $table->string('cover')->nullable();
            $table->string('email')->unique()->nullable();
            $table->text('bio')->nullable();
            $table->string('country_code')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->boolean('active')->default(true);
            $table->text('hidden_words')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
