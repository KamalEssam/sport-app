<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Match;

class MatchTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */

    protected $defaultIncludes = [
        'localteam',
        'visitorteam',
        'channel',
        'events',
        'localteam_lineup',
        'localteam_bench',
        'visitorteam_lineup',
        'visitorteam_bench',
        'referee',
        'venue',
    ];

    public function transform(Match $match)
    {
        return [
            "id"                    => $match->id,
            "localteam_formation"   => $match->localteam_formation,
            "visitorteam_formation" => $match->visitorteam_formation,
            "standings"             => [
                "localteam_position"   => $match->localteam_position,
                "visitorteam_position" => $match->visitorteam_position,
            ],
            "localteam_score"       => $match->localteam_score,
            "visitorteam_score"     => $match->visitorteam_score,
            "localteam_pen_score"   => $match->localteam_pen_score,
            "visitorteam_pen_score" => $match->visitorteam_pen_score,
            "ht_score"              => $match->ht_score,
            "ft_score"              => $match->ft_score,
            "et_score"              => $match->et_score,
            "status"                => $match->status,
            "date_time"             => $match->date_time,
            "date"                  => $match->date,
            "time"                  => $match->time,
            "timestamp"             => $match->timestamp,
            "timezone"              => $match->timezone,
        ];
    }

    public function includeLocalteam(Match $match)
    {
        $localteam = $match->localteam;
        return $this->item($localteam, new TeamTransformer);
    }

    public function includeVisitorteam(Match $match)
    {
        $visitorteam = $match->visitorteam;
        return $this->item($visitorteam, new TeamTransformer);
    }

    public function includeEvents(Match $match)
    {
        $events = $match->events;
        return $this->collection($events, new EventTransformer, 'disable');
    }

    public function includeLocalteamLineup(Match $match)
    {
        $lineup = $match->localteamLineup;
        return $this->collection($lineup, new LineupTransformer, 'disable');
    }

    public function includeLocalteamBench(Match $match)
    {
        $bench = $match->localteamBench;
        return $this->collection($bench, new BenchTransformer, 'disable');
    }

    public function includeVisitorteamLineup(Match $match)
    {
        $lineup = $match->visitorteamLineup;
        return $this->collection($lineup, new LineupTransformer, 'disable');
    }

    public function includeVisitorteamBench(Match $match)
    {
        $bench = $match->visitorteamBench;
        return $this->collection($bench, new BenchTransformer, 'disable');
    }

    public function includeChannel(Match $match)
    {
        $streamTime = $match->timestamp - $match->live_stream_time;
        $channel    = $match->channel;
        if($channel)
        {
            return $this->item($channel, new ChannelTransformer($streamTime));
        }
        return $this->primitive($channel, function ($channel) {
            return $channel;
        });
    }

    public function includeReferee(Match $match)
    {
        if($match->referee)
        {
            return $this->item($match->referee, new RefereeTransformer());
        }
        return $this->primitive($match->referee, function ($referee) {
            return $referee;
        });
    }

    public function includeVenue(Match $match)
    {
        if($match->venue)
        {
            return $this->item($match->venue, new VenueTransformer());
        }
        return $this->primitive($match->venue, function ($venue) {
            return $venue;
        });
    }


}
