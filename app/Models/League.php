<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class League extends Model
{

    protected $fillable = [
        'name',
        'league_id',
        'logo',
        'priority',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'priority',
    ];

    public function getLogoAttribute($value)
    {
        return $value == NULL ? URL('/').'/images/league.png' : URL('/').'/uploads/leagues/'.$value ;
    }

    public function matches()
    {
        return $this->hasMany(Match::class, 'league_id', 'league_id');
    }

}
