<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\League;

class LeagueController extends Controller
{
    protected $league;

    public function __construct(League $league)
    {
        $this->league = $league;
        $this->middleware('auth');
        $this->middleware('permission:CREATE_LEAGUES')->only('store');
        $this->middleware('permission:READ_LEAGUES')->only('index');
        $this->middleware('permission:UPDATE_LEAGUES')->only(['edit', 'update']);
    }

    public function index(request $request)
    {
        // GET LEAGUES
        $leagues = $this->league->when($request->search, function($query, $search)
        {
            $query->where('name', 'LIKE', '%'.$search.'%');
        })
        ->orderBy('priority','asc')
        ->paginate(10);
        return view('admin.league.index', compact('leagues'));
    }

    public function create()
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'http://football90.live/api/v1/leagues?type=all');
        $response = json_decode($response->getBody());
        $leagues  = $response->data;
        $myLeaguesIds = $this->league->pluck('league_id')->toArray();
        return view('admin.league.create', compact('leagues', 'myLeaguesIds'));
    }

    public function store(request $request)
    {
        $this->validate($request,[
            'league'   => 'required|string',
            'priority' => 'required|integer',
        ]);
        
        $league  = json_decode($request->league);
        $created = $this->league->create([
            'name'      => $league->name,
            'league_id' => $league->id,
            'priority'  => $request->priority,
            'logo'      => $league->id.'_default.png',
        ]);
        
        $file = file_get_contents($league->logo);
        $save = file_put_contents(public_path('uploads/leagues/' . $league->id.'_default.png'), $file);

        return redirect('/admin/leagues')->with(['success' => "تم تعديل البطولة"]);
    }

    public function edit($id)
    {
        $league = $this->league->findOrFail($id);
        return view('admin.league.edit', compact('league'));
    }

    public function update(request $request, $id)
    {
        
        $this->validate($request,[
            'name'     => 'required|string|max:191',
            'priority' => 'required|integer',
            'logo'     => 'nullable|image|mimes:png,jpg,jpeg,gif:max:5000',
        ]);

        $league  = $this->league->findOrFail($id);
        $league->name     = $request->name;
        $league->priority = $request->priority;
        if($request->logo)
        {
            // DELETE OLD IMAGE
    		$deleteOldImage = explode('/', $league->logo);
            $deleteOldImage = end($deleteOldImage);
            \File::delete('uploads/leagues/'.$deleteOldImage);
            // UPLOAD NEW IMAGE
            $logo = time().'.'.$request->logo->getClientOriginalExtension();
            $request->logo->move('uploads/leagues/', $logo);
	        $league->logo = $logo;
        }
        $league->save();
        return redirect('/admin/leagues')->with(['success' => "تم تعديل البطولة"]);
    }

}