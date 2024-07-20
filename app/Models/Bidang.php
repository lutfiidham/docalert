<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Bidang extends Model
{
    use HasFactory, HasUuids, SoftDeletes, Userstamps;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cabang_id',
        'nama',
        'id_kepala_bidang',
    ];

    public function dokumens(): HasMany
    {
        return $this->hasMany(Dokumen::class);
    }

    public function cabang(): BelongsTo
    {
        return $this->belongsTo(Cabang::class);
    }

    public function kepalaBidang(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_kepala_bidang', 'id');
    }
}
