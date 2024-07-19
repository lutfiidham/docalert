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
        Schema::disableForeignKeyConstraints();

        Schema::create('dokumens', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('bidang_id')->nullable()->constrained();
            $table->string('nama_dokumen');
            $table->string('nama_pekerjaan');
            $table->string('nama_perusahaan');
            $table->string('nama_pic');
            $table->string('nomor_pic');
            $table->string('email_pic');
            $table->string('berkas');
            $table->date('tgl_penerbitan');
            $table->date('tgl_kadaluarsa');
            $table->date('tgl_pengingat');
            $table->string('status_follow_up');
            $table->boolean('status_pengingat');
            $table->text('keterangan')->nullable();
            $table->string('created_by');
            $table->string('updated_by');
            $table->string('deleted_by');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumens');
    }
};
