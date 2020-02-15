<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Channel;

class ChannelTransformer extends TransformerAbstract
{

    protected $streamTime;

    public function __construct($streamTime)
    {
        $this->streamTime = $streamTime;
    }

    protected $defaultIncludes = [
        'servers',
    ];

    public function transform(Channel $channel)
    {
        return [
            'id'    => $channel->id,
            'name'  => $channel->name,
            'image' => $channel->image,
        ];
    }

    public function includeServers(Channel $channel)
    {
        if(($this->streamTime) <= time())
        {
            $servers = $channel->servers;
            return $this->collection($servers, new ServerTransformer, 'disable');
        }
        return [];
    }
}
