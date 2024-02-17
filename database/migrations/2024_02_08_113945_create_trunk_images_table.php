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
        Schema::create('trunk_images', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->enum('type', ['personal','trunk']);
            $table->enum('photo_type', [
                'personal_avatar',
                'id_photo_front',
                'id_photo_back',
                'criminal_record',
                'captain_license_front',
                'captain_license_back',
                
                'trunk_license_front',
                'trunk_license_back',
                'trunk_front',
                'trunk_back',
                'trunk_right',
                'trunk_left',
            ]);
            $table->enum('photo_status', ['accept', 'rejected', 'not_active'])->default('not_active');
            $table->string('reject_reson')->nullable();
            $table->morphs('imageable');
            $table->integer('created_by_callcenter_id')->nullable();
            $table->integer('updated_by_callcenter_id')->nullable();
            $table->timestamp('created_at_callcenter')->nullable();
            $table->timestamp('updated_at_callcenter')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trunk_images');
    }
};
