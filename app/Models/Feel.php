<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feel extends Model
{
    const TYPES = [
        'like',
        'love',
        'happy',
        'sad',
        'angry',
        'surprised',
        'thoughtful',
        'strong',
        'grateful',
        'excited',
        'bored',
        'confused',
        'proud',
        'supportive'
    ];
}
