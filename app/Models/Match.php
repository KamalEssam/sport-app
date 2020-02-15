<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{

    use \Awobaz\Compoships\Compoships;

    protected $fillable = [
        'match_id',
        'league_id',
        'localteam_name',
        'localteam_logo',
        'visitorteam_name',
        'visitorteam_logo',
        'localteam_score',
        'visitorteam_score',
        'localteam_pen_score',
        'visitorteam_pen_score',
        'ht_score',
        'ft_score',
        'et_score',
        'status',
        'date_time',
        'blog_mobile_url',
        'blog_desktop_url',
        'slug',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function league()
    {
        return $this->belongsTo(League::class, 'league_id', 'league_id');
    }

    public function matches()
    {
        return $this->hasMany(Match::class, 'date', 'date');
    }

    public function commentators()
    {
        return $this->hasMany(Commentator::class);
    }

}