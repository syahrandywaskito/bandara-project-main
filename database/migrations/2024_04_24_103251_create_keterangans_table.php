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
        Schema::create('keterangans', function (Blueprint $table) {
            $table->id();
            $table->text('keterangan')->comment('keterangan pada laporan');
            $table->date('bulan');
            $table->unsignedBigInteger('id_periode');
            $table->foreign('id_periode')->references('id')->on('periodes')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keterangans');
    }
};
