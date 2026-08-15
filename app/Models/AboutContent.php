<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutContent extends Model
{
    protected $fillable = [
        'title',
        'tagline',
        'description',
        'store_photo',
        'halal_logo',
    ];
}
