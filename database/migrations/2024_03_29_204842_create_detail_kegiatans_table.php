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
        Schema::create('detail_kegiatans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_detail_kegiatan')->comment('nama detail tambahan dari sebuah kegiatan');
            $table->unsignedBigInteger('id_kegiatan')->comment('fk dari kegiatan');
            $table->foreign('id_kegiatan')->references('id')->on('kegiatans')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_kegiatans');
    }
};
