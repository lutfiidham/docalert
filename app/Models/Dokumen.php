<?php

namespace App\Models;

use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dokumen extends Model
{
    use HasFactory, HasUuids, SoftDeletes, Userstamps;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bidang_id',
        'nama_dokumen',
        'nama_pekerjaan',
        'nama_perusahaan',
        'nama_pic',
        'nomor_pic',
        'email_pic',
        'berkas',
        'tgl_penerbitan',
        'tgl_kadaluarsa',
        'tgl_pengingat',
        'status_follow_up',
        'status_pengingat',
        'keterangan',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'tgl_penerbitan' => 'date',
        'tgl_kadaluarsa' => 'date',
        'tgl_pengingat' => 'date',
        'status_pengingat' => 'boolean',
    ];

    public function bidang(): BelongsTo
    {
        return $this->belongsTo(Bidang::class);
    }

    public function picSci(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pic_sci_id', 'id');
    }

    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id', 'id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function deletedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'deleted_by', 'id');
    }
}
