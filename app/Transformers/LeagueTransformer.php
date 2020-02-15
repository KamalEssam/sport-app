<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\League;

class LeagueTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */

    protected $availableIncludes = [
        'matches',
        'matches_groups',
        'topscorers',
        'topassists',
    ];

    public function transform(League $league)
    {
        return [
            'id'     => $league->id,
            'name'   => $league->name_ar != '' ? $league->name_ar : $league->name_en,
            'logo'   => $league->logo,
            'is_cup' => $league->is_cup == 1 ? true : false,
        ];
    }

    public function includeMatches(League $league)
    {
        $matches = $league->matches;
        return $this->collection($matches, new MatchTransformer, 'disable');
    }

    public function includeMatchesGroups(League $league)
    {
        $matches = $league->matches;
        return $this->collection($matches, new MatchGroupTransformer, 'disable');
    }

    public function includeTopscorers(League $league)
    {
        $topscorers = $league->topscorers;
        return $this->collection($topscorers, new TopscorerTransformer, 'disable');
    }

    public function includeTopassists(League $league)
    {
        $topassists = $league->topassists;
        return $this->collection($topassists, new TopassistsTransformer, 'disable');
    }

}
