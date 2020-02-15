<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adsense extends Model
{
    protected $fillable = [
        'desktop_code',
        'mobile_code',
        'video_code',
        'desktop_code_active',
        'mobile_code_active',
        'video_code_active',
    ];
}
