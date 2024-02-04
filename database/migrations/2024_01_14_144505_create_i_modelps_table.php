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
        Schema::create('i_modelps', function (Blueprint $table) {
            $table->id();
            $table->string('metode')->nullable();
            $table->string('kategori')->nullable();
            $table->string('btn')->nullable();
            $table->unsignedBigInteger('informasi_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('i_modelps');
    }
};
