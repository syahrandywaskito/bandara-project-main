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
        Schema::create('input_laporans', function (Blueprint $table) {
            $table->id();
            $table->enum('kondisi', ['normal', 'tidak normal'])->comment('kondisi peralatan');
            $table->date('tanggal_laporan')->comment('tanggal laporan diinputkan');
            $table->unsignedBigInteger('id_kegiatan')->nullable()->comment('fk dari kegiatan');
            $table->foreign('id_kegiatan')->references('id')->on('kegiatans')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('id_detail_kegiatan')->nullable()->comment('fk dari detail kegiatan');
            $table->foreign('id_detail_kegiatan')->references('id')->on('detail_kegiatans')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('input_laporans');
    }
};
