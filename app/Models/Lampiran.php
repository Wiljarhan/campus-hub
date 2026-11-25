<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lampiran extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lampirans';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'karya_id',
        'nama_file',
        'path',
        'tipe',
    ];

    /**
     * Get the karya that owns this attachment.
     */
    public function karya(): BelongsTo
    {
        return $this->belongsTo(Karya::class, 'karya_id');
    }
}
