<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Profile extends Model
{
    protected $guarded = [];
    protected $appends = ['avatar_url', 'cover_url'];
    
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function preferences(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'preferences');
    }

    public function getAvatarUrlAttribute()
    {
        return $this->avatar ? asset('storage/' . $this->avatar) : asset('images/bg.jpg');
    }

    public function getCoverUrlAttribute()
    {
        return $this->cover ? asset('storage/' . $this->cover) :  asset('images/bg.jpg');
    }
}
