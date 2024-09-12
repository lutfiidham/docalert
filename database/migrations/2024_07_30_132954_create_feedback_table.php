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
        Schema::create('feedback', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_perusahaan');
            $table->string('nama_pic');
            $table->string('email_pic');
            $table->string('nomor_hp_pic');
            $table->string('dokumen_id')->nullable();
            $table->text('alamat');
            $table->text('jasa_dibutuhkan');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
