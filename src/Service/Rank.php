<?php

namespace App\Service;

use App\Entity\User;
use App\Exception\RankException;

/**
 * Class Rank
 * @author Edwin ten Brinke <edwin.ten.brinke@extendas.com>
 */
class Rank
{
    public const RANKS = [
        'Empty Suit' => 0,
        'Deliveryboy' => 100,
        'Picciotto' => 200,
        'Shoplifter' => 400,
        'Pickpocket' => 800,
        'Thief' => 1600,
        'Associate' => 3200,
        'Mobster' => 6400,
        'Soldier' => 12800,
        'Swindler' => 25600,
        'Assasin' => 51200,
        'Local Chief' => 102400,
        'Chief' => 204800,
        'Bruglione' => 409600,
        'Godfather' => 819200,
    ];

    private $ranks;

    public function __construct($ranks_config_file)
    {
        $this->ranks = json_decode(file_get_contents($ranks_config_file));
    }

    public function getUserRank(User $user, $extra_exp = 0)
    {
        $result_rank = [];
        foreach ($this->ranks as $rank)
        {
            if(($user->getExperience() + $extra_exp) < $rank->exp)
            {
                break;
            }
            $result_rank = $rank;
        }
        return $result_rank;
    }

    public static function isAllowed(User $user, int $rank_experience)
    {
        if ($user->getExperience() < $rank_experience)
        {
            throw new RankException(
                ['message' => sprintf('You\'re not high enough rank yet, you still need %d exp.', ($rank_experience - $user->getExperience()))]
            );
        }
    }

    public function getCarChance(User $user, int $rank_experience)
    {

    }
}
