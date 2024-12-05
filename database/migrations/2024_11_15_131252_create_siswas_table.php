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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nis', 16);
            $table->unsignedBigInteger('kelas_id');
            $table->date('tanggal_lahir');
            $table->char('telepon', 13);
            $table->unsignedBigInteger('orang_tua_id');
            $table->string('alamat');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign(columns: 'orang_tua_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign(columns: 'kelas_id')->references('id')->on('kelas')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
