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
        Schema::create('data_moduls', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->unsignedBigInteger('informasi_id')->nullable();
            $table->unsignedBigInteger('komponen_id')->nullable();
            $table->unsignedBigInteger('lampiran_id')->nullable();
            $table->unsignedBigInteger('users_id');
            //$table->char('status',1)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_moduls');
    }
};
