<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Team;

class TeamTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    protected $defaultIncludes = [
        'country',
        'coach',
    ];

    public function transform(Team $team)
    {
        return [
            "id"            => $team->id,
            "name"          => $team->name,
            "logo"          => $team->logo,
            "short_code"    => $team->short_code,
            "founded"       => $team->founded,
            "national_team" => $team->national_team == 1 ? true : false,
            "twitter"       => $team->twitter,
        ];
    }

    public function includeCountry(Team $team)
    {
        if(!$team->country)
        {
            return $this->primitive($team->country, function ($country) {
                return $country;
            });
        }
        return $this->item($team->country, new CountryTransformer);
    }

    public function includeCoach(Team $team)
    {
        if(!$team->coach)
        {
            return $this->primitive($team->coach, function ($coach) {
                return $coach;
            });
        }
        return $this->item($team->coach, new CoachTransformer);
    }
}
