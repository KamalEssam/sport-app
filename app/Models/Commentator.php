<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commentator extends Model
{
    protected $fillable = [
        'name',
        'match_id',
    ];

    public function channels()
    {
        return $this->hasManyThrough(Channel::class, CommentatorChannel::class, 'commentator_id', 'id', 'id', 'channel_id');
    }
}
