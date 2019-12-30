<?php

namespace App\Helper;

/**
 * Class Random
 * @author Edwin ten Brinke <edwin.ten.brinke@extendas.com>
 */
class Random
{
    /**
     * @param int $min
     * @param int $max
     *
     * @return int
     * @throws \Exception
     */
    public static function chance($min = 0, $max = 99)
    {
        return random_int($min, $max);
    }

    /**
     * @param $min
     * @param $max
     *
     * @return int
     * @throws \Exception
     */
    public static function between($min, $max)
    {
        return self::chance($min, $max);
    }
}
