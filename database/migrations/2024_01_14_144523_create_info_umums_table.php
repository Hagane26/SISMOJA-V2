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
        Schema::create('info_umums', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('identitas_id')->nullable();
            $table->text('komponenAwal')->nullable();
            $table->text('sarana')->nullable();
            $table->text('prasarana')->nullable();
            $table->string('target')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_umums');
    }
};
