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
            $table->string('pelanggan_id')->nullable()->constrained();
            $table->string('nama_pic')->nullable();
            $table->string('nomor_pic')->nullable();
            $table->string('email_pic')->nullable();
            $table->string('pic_sci_id')->nullable()->constarined();
            $table->string('berkas')->nullable();
            $table->date('tgl_penerbitan')->nullable();
            $table->date('tgl_kadaluarsa')->nullable();
            $table->date('tgl_pengingat')->nullable();
            $table->string('status_follow_up')->nullable();
            $table->boolean('status_pengingat')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
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
