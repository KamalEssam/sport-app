<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Adsense;
use Cache;

class AdsenseController extends Controller
{    
    protected $adsense;

    public function __construct(Adsense $adsense)
    {
        $this->adsense = $adsense;
        $this->middleware('auth');
        $this->middleware('permission:UPDATE_ADSENSES')->only(['edit', 'update']);
    }

    public function edit()
    {
        $adsense = $this->adsense->first();
        return view('admin.adsense.edit', compact('adsense'));
    }

    public function update(request $request)
    {    
        $this->validate($request, [
            'video_code'          => 'nullable|string',
            'desktop_code'        => 'nullable|string',
            'mobile_code'         => 'nullable|string',
            'video_code_active'   => 'nullable|in:true,false',
            'desktop_code_active' => 'nullable|in:true,false',
            'mobile_code_active'  => 'nullable|in:true,false',
        ]);
        $data = $request->all();
        $data['video_code_active']   = $request->video_code_active == "true" ? true : false;
        $data['desktop_code_active'] = $request->desktop_code_active == "true" ? true : false;
        $data['mobile_code_active']  = $request->mobile_code_active == "true" ? true : false;
        $adsense = $this->adsense->first();
        $update  = $adsense->update($data);
        $adsense->fresh();

        Cache::forever('adsense', $adsense);
        return back()->with(['success' => "تم تعديل الاعلانات"]);
    }

}