<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UndanganRekrutmen extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'undangan_rekrutmens';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'karya_id',
        'recruiter_id',
        'mahasiswa_id',
        'posisi',
        'pesan',
        'status',
    ];

    /**
     * Get the karya associated with this recruitment invitation.
     */
    public function karya(): BelongsTo
    {
        return $this->belongsTo(Karya::class, 'karya_id');
    }

    /**
     * Get the recruiter user who sent this invitation.
     */
    public function recruiter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recruiter_id');
    }

    /**
     * Get the mahasiswa user invited by this recruitment invitation.
     */
    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(User::class, 'mahasiswa_id');
    }
}
