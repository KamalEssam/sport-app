<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Channel;
use Cache;

class ChannelController extends Controller
{
    protected $channel;

    public function __construct(Channel $channel)
    {
        $this->channel = $channel;
        $this->middleware('auth');
        $this->middleware('permission:CREATE_CHANNELS')->only(['create', 'store']);
        $this->middleware('permission:READ_CHANNELS')->only('index');
        $this->middleware('permission:UPDATE_CHANNELS')->only(['edit', 'update']);
        $this->middleware('permission:DELETE_CHANNELS')->only('destroy');
    }

    public function index(request $request)
    {
        $channels = $this->channel->when($request->search, function($query, $search){
            $query->where('name', 'LIKE', '%'.$search.'%');
        })->orderBy('name','asc')->paginate(50);
        return view('admin.channel.index', compact('channels'));
    }

    public function create()
    {
        return view('admin.channel.create');
    }

    public function store(request $request)
    {
        $this->validate($request,[
            'name'  => 'required|string|max:191',
            'slug'  => 'nullable|max:191|regex:/^[a-zA-Z0-9_-]*$/|unique:channels,slug',

        ]);
        $channel = $this->channel->create(['name' => $request->name, 'slug' => $request->slug ]);
        $channel->save();
        $channel->fresh();

        Cache::forever('channel'.$channel->id, $channel);
        return redirect('/admin/channels')->with(['success' => "تم أضافة القناة"]);
    }

    public function edit($id)
    {
        $channel = $this->channel->find($id);
        return view('admin.channel.edit', compact('channel'));
    }

    public function update(request $request, $id)
    {
        $this->validate($request,[
            'name'  => 'required|string|max:191',
            'slug'  => 'nullable|max:191|regex:/^[a-zA-Z0-9_-]*$/|unique:channels,slug,'.$id,
        ]);
        $channel = $this->channel->find($id);
        $channel->name = $request->name;
        $channel->slug = $request->slug;
        $channel->save();
        $channel->fresh();

        Cache::forever('channel'.$id, $channel);
        return redirect('/admin/channels')->with(['success' => "تم تعديل القناة"]);
    }

    public function destroy($id)
    {
        $deleted = $this->channel->find($id)->delete();
        Cache::forget('channel'.$id);
        return back()->with(['success' => "تم حذف القناة"]);
    }

}