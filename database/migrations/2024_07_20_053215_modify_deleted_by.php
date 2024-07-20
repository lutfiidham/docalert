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
        Schema::table('cabangs', function (Blueprint $table) {
            $table->string('created_by')->nullable()->change();
            $table->string('updated_by')->nullable()->change();
            $table->string('deleted_by')->nullable()->change();
        });
        Schema::table('bidangs', function (Blueprint $table) {
            $table->string('created_by')->nullable()->change();
            $table->string('updated_by')->nullable()->change();
            $table->string('deleted_by')->nullable()->change();
        });
        Schema::table('dokumens', function (Blueprint $table) {
            $table->string('created_by')->nullable()->change();
            $table->string('updated_by')->nullable()->change();
            $table->string('deleted_by')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cabangs', function (Blueprint $table) {
            $table->string('created_by')->change();
            $table->string('updated_by')->change();
            $table->string('deleted_by')->change();
        });
        Schema::table('bidangs', function (Blueprint $table) {
            $table->string('created_by')->change();
            $table->string('updated_by')->change();
            $table->string('deleted_by')->change();
        });
        Schema::table('dokumens', function (Blueprint $table) {
            $table->string('created_by')->change();
            $table->string('updated_by')->change();
            $table->string('deleted_by')->change();
        });
    }
};
