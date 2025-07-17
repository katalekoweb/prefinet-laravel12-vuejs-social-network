<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Profile extends Model
{
    protected $guarded = [];
    public function tags () : BelongsToMany {
        return $this->belongsToMany(Tag::class);
    }
}
