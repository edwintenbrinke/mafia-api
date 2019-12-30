<?php

namespace App\Helper;

use App\Exception\CooldownException;
use DateTime;
use Exception;

/**
 * Class Message
 * @author Edwin ten Brinke <edwin.ten.brinke@extendas.com>
 */
class Time
{
    /**
     * @param int $minutes
     *
     * @return DateTime
     * @throws Exception
     */
    public static function addMinutes(int $minutes)
    {
        return new DateTime(sprintf('+%d minutes', $minutes));
    }

    /**
     * @param int $seconds
     *
     * @return DateTime
     * @throws Exception
     */
    public static function addSeconds(int $seconds)
    {
        return new DateTime(sprintf('+%d seconds', $seconds));
    }

    public static function isFuture(DateTime $future)
    {
        if ($future > new DateTime())
        {
            throw new CooldownException(
                ['message' => sprintf('You need to wait %s before you can do this again.',Time::diff($future))],
                $future
            );
        }
        return false;
    }

    public static function diff(DateTime $future)
    {
        return $future->diff(new DateTime())->format('%h:%i:%s');
    }
}
