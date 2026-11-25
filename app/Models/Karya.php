<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Karya extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'karyas';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'kategori_id',
        'judul',
        'ringkasan',
        'link_demo',
        'link_repo',
        'status',
    ];

    /**
     * Get the mahasiswa (owner) of this karya.
     */
    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the category of this karya.
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    /**
     * Get all attachments for this karya.
     */
    public function lampirans(): HasMany
    {
        return $this->hasMany(Lampiran::class, 'karya_id');
    }

    /**
     * Get the verification record for this karya.
     */
    public function verifikasi(): HasOne
    {
        return $this->hasOne(Verifikasi::class, 'karya_id');
    }

    /**
     * Get all adoption requests for this karya.
     */
    public function permintaanAdopsis(): HasMany
    {
        return $this->hasMany(PermintaanAdopsi::class, 'karya_id');
    }

    /**
     * Get all recruitment invitations for this karya.
     */
    public function undanganRekrutmens(): HasMany
    {
        return $this->hasMany(UndanganRekrutmen::class, 'karya_id');
    }
}
