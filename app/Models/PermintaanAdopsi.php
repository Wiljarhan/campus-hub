<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PermintaanAdopsi extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'permintaan_adopsis';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'karya_id',
        'umkm_id',
        'pesan',
        'status',
    ];

    /**
     * Get the karya requested for adoption.
     */
    public function karya(): BelongsTo
    {
        return $this->belongsTo(Karya::class, 'karya_id');
    }

    /**
     * Get the UMKM user who submitted the adoption request.
     */
    public function umkm(): BelongsTo
    {
        return $this->belongsTo(User::class, 'umkm_id');
    }
}
