<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('captain_trucks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('captain_id')->constrained('captains')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('trunk_make_id')->nullable()->constrained('trunk_makes')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('trunk_model_id')->nullable()->constrained('trunk_models')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('trunk_number')->nullable();
            $table->string('trunk_color')->nullable();
            $table->year('trunk_year')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('captain_trucks');
    }
};
