<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Server;
use App\Models\ServerType;
use App\Models\Channel;
use Cache;

class ServerController extends Controller
{    
    protected $server;
    protected $serverType;
    protected $channel;

    public function __construct(Server $server, ServerType $serverType, Channel $channel)
    {
        $this->server = $server;
        $this->serverType = $serverType;
        $this->channel = $channel;
        $this->middleware('auth')->except('show');
        $this->middleware('permission:CREATE_SERVERS')->only(['create', 'store']);
        $this->middleware('permission:READ_SERVERS')->only('index');
        $this->middleware('permission:UPDATE_SERVERS')->only(['edit', 'update', 'featured', 'status']);
        $this->middleware('permission:DELETE_SERVERS')->only('destroy');
    }

    public function index(request $request)
    {
        $serverTypes = $this->serverType->all();
        $channels    = $this->channel->all();
        $servers = $this->server->latest('id')
        ->when($request->channelId, function($query, $channelId){
            $query->where('channel_id', $channelId);
        })
        ->when($request->serverTypeId, function($query, $serverTypeId){
            $query->where('server_type_id', $serverTypeId);
        })
        ->when($request->quality, function($query, $quality){
            $query->where('quality', $quality);
        })
        ->when($request->status, function($query, $status){
            $query->where('status', $status == 'active' ? 1 : 0);
        })
        ->paginate(50);
        return view('admin.server.index', compact('servers', 'channels', 'serverTypes'));
    }

    public function show($id)
    {
        $server = $this->server->find($id);
        return view('admin.server.show', compact('server'));
    }

    public function create()
    {
        $channels    = Channel::all();
        $serverTypes = ServerType::all();
        return view('admin.server.create', compact('channels', 'serverTypes'));
    }

    public function store(request $request)
    {    
        $this->validate($request, [
            'name'           => 'required|string|max:191',
            'quality'        => 'required|in:MAIN,HIGH,MEDIUM,LOW',
            'work_on'        => 'required|in:ALL,DESKTOP,MOBILE',
            'channel_id'     => 'required|integer',
            'server_type_id' => 'required|integer',
            'code'           => 'required',
        ]);
        $server = $this->server->create($request->all());
        $server->fresh()->with('channel');

        Cache::forever('server'.$server->id, $server);
        Cache::forget('channel'.$server->channel_id);
        Cache::forget('channel'.$server->channel->slug);
        return redirect('/admin/servers')->with(['success' => "تم أضافة السيرفر"]);
    }

    public function edit($id)
    {
        $server = $this->server->find($id);
        $channels = Channel::all();
        $serverTypes = ServerType::all();
        return view('admin.server.edit', compact('server', 'serverTypes', 'channels'));
    }

    public function update(request $request, $id)
    {    
        $this->validate($request, [
            'name'           => 'required|string|max:191',
            'quality'        => 'required|in:MAIN,HIGH,MEDIUM,LOW',
            'work_on'        => 'required|in:ALL,DESKTOP,MOBILE',
            'channel_id'     => 'required|integer',
            'server_type_id' => 'required|integer',
            'code'           => 'required',
        ]);
        $server  = $this->server->find($id);
        $updated = $server->update($request->all());
        $server->fresh()->with('channel');

        Cache::forever('server'.$id, $server);
        Cache::forget('channel'.$server->channel_id);
        Cache::forget('channel'.$server->channel->slug);
        return back()->with(['success' => "تم تعديل السيرفر"]);
    }

    public function destroy($id)
    {
        $server  = $this->server->find($id);
        $deleted = $server->delete();
        Cache::forget('server'.$id);
        Cache::forget('channel'.$server->channel_id);
        Cache::forget('channel'.$server->channel->slug);
        return redirect('/admin/servers')->with(['success' => "تم حذف السيرفر"]);
    }

    public function status($id)
    {
        $server = $this->server->find($id);
        $server->status = $server->status == 1 ? 0 : 1;
        $server->save();
        $server->fresh();

        Cache::forever('server'.$id, $server);
        Cache::forget('channel'.$server->channel_id);
        Cache::forget('channel'.$server->channel->slug);
        return back()->with(['success' => "تم تعديل حالة السيرفر"]);
    }

    public function featured($id)
    {
        $server = $this->server->find($id);
        $server->is_featured = $server->is_featured == 1 ? 0 : 1;
        $server->save();
        $server->fresh();

        Cache::forever('server'.$id, $server);
        Cache::forget('channel'.$server->channel_id);
        Cache::forget('channel'.$server->channel->slug);
        return back()->with(['success' => "تم تعديل تميز السيرفر"]);
    }

    public function adblock($id)
    {
        $server = $this->server->find($id);
        $server->ads_block = $server->ads_block == 1 ? 0 : 1;
        $server->save();
        $server->fresh();

        Cache::forever('server'.$id, $server);
        Cache::forget('channel'.$server->channel_id);
        Cache::forget('channel'.$server->channel->slug);
        return back()->with(['success' => "تم تعديل مانع الاعلانات السيرفر"]);
    }

}