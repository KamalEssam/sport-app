<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentatorChannel extends Model
{
    protected $fillable = [
        'commentator_id',
        'channel_id',
    ];

    public function commentator()
    {
        return $this->belongs(Commentator::class);
    }

    public function channel()
    {
        return $this->belongs(Channel::class);
    }

}
