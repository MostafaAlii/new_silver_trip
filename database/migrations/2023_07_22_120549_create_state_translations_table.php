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
        Schema::create('state_translations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('locale');
            $table->unique(['state_id', 'locale']);
            $table->index(['name', 'locale']);
            $table->foreignId('state_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('state_translations');
    }
};