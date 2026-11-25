<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Verifikasi extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'verifikasis';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'karya_id',
        'verifikator_id',
        'hasil',
        'catatan',
    ];

    /**
     * Get the karya being verified.
     */
    public function karya(): BelongsTo
    {
        return $this->belongsTo(Karya::class, 'karya_id');
    }

    /**
     * Get the user who verified the karya.
     */
    public function verifikator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verifikator_id');
    }
}
