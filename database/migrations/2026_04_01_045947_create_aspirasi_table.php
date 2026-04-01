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
    Schema::create('aspirasi', function (Blueprint $table) {
        $table->id('id_aspirasi'); // Mengganti 'id' bawaan jadi 'id_aspirasi'
        $table->enum('status', ['menunggu', 'proses', 'selesai']);
        $table->unsignedBigInteger('id_pelaporan');
        $table->text('feedback');
        $table->timestamps();

        // Jangan lupa tambahin foreign key-nya di sini nanti
        // $table->foreign('id_pelaporan')->references('id_pelaporan')->on('input_aspirasi');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspirasi');
    }
};
