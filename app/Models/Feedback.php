<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'nama_perusahaan',
        'nama_pic',
        'email_pic',
        'nomor_hp_pic',
        'alamat',
        'jasa_dibutuhkan',
        'keterangan',
    ];
}
