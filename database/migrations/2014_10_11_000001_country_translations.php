<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('country_translations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('locale');
            $table->unique(['country_id', 'locale']);
            $table->index(['name', 'locale']);
            $table->foreignId('country_id')->constrained()->cascadeOnDelete();
        });
    }

    public function down(): void {
        
    }
};