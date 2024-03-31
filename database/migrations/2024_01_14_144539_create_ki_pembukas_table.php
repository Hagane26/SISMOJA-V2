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
        Schema::create('ki_pembukas', function (Blueprint $table) {
            $table->id();
            $table->string('langkah')->nullable();
            $table->text('isi')->nullable();
            $table->integer('waktu')->nullable();
            $table->integer('pertemuan')->nullable();
            $table->unsignedBigInteger('ki_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ki_pembukas');
    }
};
