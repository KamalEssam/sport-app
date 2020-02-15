<?php

namespace App\Http\Controllers\App;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\League;
use Cache;

class HomeController extends Controller
{
    protected $league;

    public function __construct(League $league)
    {
        $this->league = $league;
    }

    public function index(Request $request)
    {
        $date = $request->date ? $request->date : date('Y-m-d');

        if(Cache::has('leagues'.$date))
        {
            $leagues = Cache::get('leagues'.$date);
        }
        else
        {
            $leagues = $this->league
            ->with(['matches' => function($query) use($date){
                $query->whereDate('date_time', $date);
                $query->where('blog_desktop_url', '!=', null);
                $query->orderByRaw("IF(`status` = 'LIVE', 0, 1)  ASC");
                $query->orderByRaw("IF(`status` = 'NS', 0, 1)  ASC");
                $query->orderBy('date_time', 'ASC');
            }])
            ->whereHas('matches', function($query) use($date){
                $query->whereDate('date_time', $date);
                $query->where('blog_desktop_url', '!=', null);
            })
            ->get();
            Cache::forever('leagues'.$date, $leagues);
        }

        return view('app.home-inner', compact('leagues'));
    }

}