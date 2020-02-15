<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class MatchGroupTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */

    protected $defaultIncludes = [
        'matches',
    ];

    public function transform($data)
    {
        return [
            'date' => $data->date,
        ];
    }

    public function includeMatches($data)
    {
        $matches = $data->matches;
        return $this->collection($matches, new MatchTransformer, 'disable');
    }

}
