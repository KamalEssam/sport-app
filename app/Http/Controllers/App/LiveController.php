<?php

namespace App\Http\Controllers\App;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Match;
use App\Models\Channel;
use App\Models\Server;
use App\Models\Adsense;
use Cache;

class LiveController extends Controller
{
    
    protected $match;
    protected $channel;
    protected $server;
    protected $adsense;

    public function __construct(Match $match, Channel $channel, Server $server, Adsense $adsense)
    {
        $this->match   = $match;
        $this->channel = $channel;
        $this->server  = $server;
        $this->adsense = $adsense;
    }

    public function show($id)
    {
        if(Cache::has('match'.$id))
        {
            $match = Cache::get('match'.$id);
        }else{
            $match = $this->match
            ->with(['commentators' => function($query){
                $query->with(['channels' => function($query){
                    $query->with(['servers' => function($query){
                        $query->select('channel_id', 'quality')->groupBy('channel_id', 'quality');
                        $query->with(['servers' => function($query){
                            $query->where('status', 1);
                            $query->with('serverType');
                        }]);
                    }]);
                }]);
            }])
            ->where('id', $id)
            ->orWhere('slug', $id)
            ->firstOrFail();
            Cache::forever('match'.$id, $match);
        }
        return view('app.match', compact('match'));
    }

    public function showChannel($id)
    {
        if(Cache::has('channel'.$id))
        {
            $channel = Cache::get('channel'.$id);
        }else{
            $channel = $this->channel
            ->with(['servers' => function($query){
                $query->select('channel_id', 'quality')->groupBy('channel_id', 'quality');
                $query->with(['servers' => function($query){
                    $query->where('status', 1);
                    $query->with('serverType');
                }]);
            }])
            ->where('id', $id)
            ->orWhere('slug', $id)
            ->firstOrFail();
            Cache::forever('channel'.$id, $channel);
        }
        return view('app.channel', compact('channel'));
    }

    public function iframeInner($id)
    {
        if(Cache::has('server'.$id))
        {
            $server = Cache::get('server'.$id);
        }else{
            $server = $this->server->with('channel')->find($id);
            Cache::forever('server'.$id, $server);
        }
        return view('app.iframe-inner', compact('server'));
    }

    public function iframeOuter($id)
    {
        if(Cache::has('server'.$id))
        {
            $server = Cache::get('server'.$id);
        }else{
            $server = $this->server->with('channel')->find($id);
            Cache::forever('server'.$id, $server);
        }

        if(Cache::has('adsense'))
        {
            $adsense = Cache::get('adsense');
        }else{
            $adsense = $this->adsense->first();
            Cache::forever('adsense', $adsense);
        }

        return view('app.iframe-outer', compact('server', 'adsense'));
    }

}