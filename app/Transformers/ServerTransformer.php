<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Server;
use Helper;

class ServerTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Server $server)
    {
        return [
            'id'   => $server->id,
            'name' => $server->name,
            'type' => $server->type,
            'url'  => $server->type != 'SECURE' ? $server->url : Helper::getStreamUrlAfterRedirect($server->url),
        ];
    }
}
