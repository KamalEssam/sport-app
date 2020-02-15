<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    use \Awobaz\Compoships\Compoships;

    protected $fillable = [
        'name',
        'quality',
        'work_on',
        'server_type_id',
        'code',
        'channel_id',
        'status',
        'is_featured',
        'ads_block',
    ];

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function serverType()
    {
        return $this->belongsTo(ServerType::class);
    }

    public function servers()
    {
        return $this->hasMany(Server::class, ['quality', 'channel_id'], ['quality', 'channel_id']);
    }

}
