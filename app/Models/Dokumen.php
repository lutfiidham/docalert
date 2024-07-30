<?php

namespace App\Models;

use Wildside\Userstamps\Userstamps;
use Guava\Calendar\ValueObjects\Event;
use Guava\Calendar\Contracts\Eventable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dokumen extends Model implements Eventable
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

    public function toEvent(): Event|array {
        return Event::make($this)
            ->title($this->nama_pekerjaan)
            ->start($this->tgl_pengingat)
            ->end($this->tgl_pengingat);
    }

    public static function getDokumenEvents()
    {
        $dokumens = Dokumen::all();
        $events = $dokumens->map(function ($dokumen) {
            return [
                'title' => $dokumen->nama_pekerjaan,
                'start' => $dokumen->tgl_pengingat,
                'end' => $dokumen->tgl_pengingat,
            ];
        })->toArray();
        $event2 = $dokumens->map(function ($dokumen) {
            return [
                'title' => $dokumen->nama_pekerjaan,
                'start' => $dokumen->tgl_kadaluarsa,
                'end' => $dokumen->tgl_kadaluarsa,
                'backgroundColor' => '#ff0000',
                'action' => 'edit'
            ];
        })->toArray();
        // var_dump($events);
        return array_merge($events,$event2);
    }

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
