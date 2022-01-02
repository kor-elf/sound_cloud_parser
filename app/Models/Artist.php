<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Artist extends Model
{
    use HasFactory, SoftDeletes;

    const SERVICE_SOUNDCLOUD = 1;

    protected $fillable = [
        'service_id',
        'service_type',
        'followers',
        'link',
        'full_name',
        'username',
        'description',
        'city',
        'country_code'
    ];

    public function tracks(): HasMany
    {
        return $this->hasMany(Track::class);
    }
}
