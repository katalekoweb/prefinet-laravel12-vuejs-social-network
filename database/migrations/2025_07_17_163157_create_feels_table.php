<?php

use App\Models\Feel;
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
        Schema::create('feels', function (Blueprint $table) {
            $table->id();
            $table->uuid()->nullable();
            $table->foreignId('profile_id')->constrained()->cascadeOnDelete();
            $table->foreignId('post_id')->constrained()->cascadeOnDelete();
            $table->enum('type', [Feel::TYPES]);
            $table->enum('status', ['published', 'archived', 'draft'])->default('published');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feels');
    }
};
