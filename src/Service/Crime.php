<?php

namespace App\Service;

use App\Entity\User;
use App\Helper\Message;
use App\Helper\Random;
use App\Helper\Time;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Class Crime
 * @author Edwin ten Brinke <edwin.ten.brinke@extendas.com>
 */
class Crime
{
    public const CRIME_JACKPOT_CHANCE = 2.5;

    private $translator;
    private $rank;

    public function __construct(Rank $rank, TranslatorInterface $translator)
    {
        $this->translator = $translator;
        $this->rank = $rank;
    }

    /**
     * @param User $user
     *
     * @return int
     * @throws \Exception
     */
    public function executeCrime(User $user)
    {
        $rank = $this->rank->getUserRank($user);

        // TODO Prison check
        // RANK: Empty suit

        // check cooldown
        Time::isFuture($user->getCooldown()->getCrime());

        $amount = null;
        $chance = Random::chance();
        switch(true) {
            case $chance < self::CRIME_JACKPOT_CHANCE:
                $amount = Random::between(1000, 2500);
                $message = Message::jackpot($amount);
                break;
            case $chance < $rank->crime_chance:
                $amount = Random::between(100, 250);
                $message = Message::success($amount);
                break;
            default:
                //failed
                $message = Message::failure();
        }

        if ($amount)
        {
            $user->addCash($amount);
            $user->addExperience(10);
            $user->getCounter()->addCrime();
        }

        // set cooldown
        $user->getCooldown()->setCrime(Time::addMinutes(1));

        return $message;
    }

    /**
     * @param User $user
     *
     * @return int
     * @throws \Exception
     */
    public function executeOrganizedCrime(User $user)
    {
        $rank = $this->rank->getUserRank($user);

        //TODO prison
        Rank::isAllowed($user, Rank::RANKS['Deliveryboy']);
        Time::isFuture($user->getCooldown()->getOrganizedCrime());

        $amount = null;
        $chance = Random::chance();
        switch(true) {
            case $chance < self::CRIME_JACKPOT_CHANCE:
                $amount = (Random::between(750, 1500) * 5);
                $message = Message::jackpot($amount);
                break;
            case $chance < $rank->crime_chance:
                $amount = Random::between(750, 1500);
                $message = Message::success($amount);
                break;
            default:
                //failed
                $message = Message::failure();
        }

        if ($amount)
        {
            $user->addCash($amount);
            $user->addExperience(50);
            $user->getCounter()->addOrganizedCrime();
        }

        // set cooldown
        $user->getCooldown()->setOrganizedCrime(Time::addMinutes(3));

        return $message;
    }
}
