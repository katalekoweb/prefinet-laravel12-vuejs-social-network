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
        Schema::create('followers', function (Blueprint $table) {
            $table->id();
            $table->uuid()->nullable();
            $table->foreignId('profile_follower_id')->constrained('profiles')->cascadeOnDelete();
            $table->foreignId('profile_followed_id')->constrained('profiles')->cascadeOnDelete();
            $table->boolean('active')->default(true);
            $table->timestamp('accepted_at');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('followers');
    }
};
