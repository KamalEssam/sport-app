<?php

namespace App\Jobs;

ini_set('max_execution_time', 0);

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Models\League;
use App\Models\Match;
use Cache;

class Fixtures implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $match;
    protected $league;

    public function __construct()
    {
        //
    }

    public function handle(Match $match, League $league)
    {
        $this->match      = $match;
        $this->league     = $league;

        // GET ACTIVE LEAGUES
        $leaguesIds = $this->league->pluck('league_id')->toArray();
    
        if(count($leaguesIds) > 0)
        {
            $dateFrom = date('Y-m-d');
            $dateTo   = date('Y-m-d', strtotime('+2 day'));
            $i        = 1;
        
            do {    

                $client = new \GuzzleHttp\Client();
                $response = $client->request('GET', 'http://football90.live/api/v1/matches', [
                    'query' => [
                        'type'       => 'list',
                        'dateFrom'   => $dateFrom,
                        'dateTo'     => $dateTo,
                        'leaguesIds' => $leaguesIds,
                    ]
                ]);
                $response = json_decode($response->getBody());
                $leagues  = $response->data;

                foreach($response->data as $match)
                {
                    if(!file_exists(public_path('uploads/teams/' . $match->localteam->id.'_default.png')))
                    {
                        $file = file_get_contents($match->localteam->logo);
                        $save = file_put_contents(public_path('uploads/teams/' . $match->localteam->id.'_default.png'), $file);
                    }

                    if(!file_exists(public_path('uploads/teams/' . $match->visitorteam->id.'_default.png')))
                    {
                        $file = file_get_contents($match->visitorteam->logo);
                        $save = file_put_contents(public_path('uploads/teams/' . $match->visitorteam->id.'_default.png'), $file);
                    }

                    // CREATE OR UPDATE MATCH
                    $created = $this->match->updateOrCreate([
                        'match_id'              => $match->id,
                    ],[
                        'match_id'              => $match->id,
                        'league_id'             => $match->league->id,
                        'localteam_name'        => $match->localteam->name,
                        'localteam_logo'        => $match->localteam->id.'_default.png',
                        'visitorteam_name'      => $match->visitorteam->name,
                        'visitorteam_logo'      => $match->visitorteam->id.'_default.png',
                        'localteam_score'       => $match->localteam_score,
                        'visitorteam_score'     => $match->visitorteam_score,
                        'localteam_pen_score'   => $match->localteam_pen_score,
                        'visitorteam_pen_score' => $match->visitorteam_pen_score,
                        'ht_score'              => $match->ht_score,
                        'ft_score'              => $match->ft_score,
                        'et_score'              => $match->et_score,
                        'status'                => $match->status,
                        'date_time'             => $match->date_time,
                    ]);
                }
                $i++;
            }while($i <= $response->meta->pagination->total_pages);
        }

        $date = date('Y-m-d');
        Cache::forget('leagues'.$date);

        \Log::info("FIXTURES");
    }

}
