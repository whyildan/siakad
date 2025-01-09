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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('student_identification_number', 16);
            $table->date('date_of_birth');
            $table->char('phone_number', 13);
            $table->unsignedBigInteger('parent_id');
            $table->string('address');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign(columns: 'parent_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};