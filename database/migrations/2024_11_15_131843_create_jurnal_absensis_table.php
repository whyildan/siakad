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
        Schema::create('jurnal_absensis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jurnal_id');
            $table->unsignedBigInteger('siswa_id');
            $table->enum('status', ['Hadir','Terlambat', 'Sakit', 'Ijin', 'Alpha']);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('jurnal_id')->references('id')->on('jurnals')->cascadeOnDelete();
            $table->foreign('siswa_id')->references('id')->on('siswas')->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurnal_absensis');
    }
};
