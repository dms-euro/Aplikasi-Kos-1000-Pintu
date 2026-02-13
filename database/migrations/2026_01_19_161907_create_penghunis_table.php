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
        Schema::create('penghuni', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->constrained('users');
            $table->string('nama');
            $table->enum('kelamin',['Laki-laki','Perempuan']);
            $table->date('taggal_lahir');
            $table->enum('pekerjaan',['Karyawan','Mahasiswa','Lainnya'])->default('Lainnya');
            $table->string('kontak');
            $table->string('kontak_darurat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penghuni');
    }
};
