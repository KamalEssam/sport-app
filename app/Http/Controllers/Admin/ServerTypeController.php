<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\ServerType;

class ServerTypeController extends Controller
{
    
    protected $serverType;

    public function __construct(ServerType $serverType)
    {
        $this->serverType = $serverType;
        $this->middleware('auth');
        $this->middleware('permission:CREATE_SERVER_TYPES')->only(['create', 'store']);
        $this->middleware('permission:READ_SERVER_TYPES')->only('index');
        $this->middleware('permission:UPDATE_SERVER_TYPES')->only(['edit', 'update']);
        $this->middleware('permission:DELETE_SERVER_TYPES')->only('destroy');
    }

    public function index()
    {
        $serverTypes = $this->serverType->latest('id')->paginate(50);
        return view('admin.server.type.index', compact('serverTypes'));
    }

    public function create()
    {
        return view('admin.server.type.create');
    }

    public function store(request $request)
    {    
        $this->validate($request,[
            'name' => 'required|string',
            'code' => 'required|string',
        ]);
        $serverType = $this->serverType->create($request->all());
        return redirect('/admin/servers-types')->with(['success' => "تم أضافة نوع السيرفر"]);
    }

    public function edit($id)
    {
        $serverType = $this->serverType->find($id);
        return view('admin.server.type.edit', compact('serverType'));
    }

    public function update(request $request, $id)
    {    
        $this->validate($request,[
            'name' => 'required|string',
            'code' => 'required|string',
        ]);
        $serverType = $this->serverType->find($id);
        $serverType->update($request->all());
        return redirect('/admin/servers-types')->with(['success' => "تم تعديل نوع السيرفر"]);
    }

    public function destroy($id)
    {
        $serverType = $this->serverType->find($id);
        $deleted    = $serverType->delete();
        return redirect('/admin/servers-types')->with(['success' => "تم حذف نوع سيرفر"]);
    }

}