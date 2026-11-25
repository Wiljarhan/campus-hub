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
        Schema::create('permintaan_adopsis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karya_id')->constrained('karyas')->cascadeOnDelete();
            $table->foreignId('umkm_id')->constrained('users');
            $table->text('pesan');
            $table->string('status')->default('menunggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permintaan_adopsis');
    }
};
