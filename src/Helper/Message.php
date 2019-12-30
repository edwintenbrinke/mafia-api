<?php

namespace App\Helper;

/**
 * Class Message
 * @author Edwin ten Brinke <edwin.ten.brinke@extendas.com>
 */
class Message
{
    /**
     * amount must be formatted
     *
     * @param string $formatted_amount
     *
     * @return string
     */
    public static function jackpot(string $formatted_amount)
    {
        return sprintf("Jackpot! You recieved %s.",$formatted_amount);
    }

    public static function success(string $formatted_amount)
    {
        return sprintf("Success! You recieved %s.",$formatted_amount);
    }

    public static function failure()
    {
        return "Failure!";
    }
}
