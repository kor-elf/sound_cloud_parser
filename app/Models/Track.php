<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Track extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'service_track_id',
        'title',
        'duration',
        'link',
        'description',
        'license',
        'comments',
        'likes',
        'playback',
        'download'
    ];

    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class);
    }
}
