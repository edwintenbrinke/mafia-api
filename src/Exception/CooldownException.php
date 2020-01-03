<?php

namespace App\Exception;

use App\Entity\Cooldown;
use DateTimeInterface;

/**
 * Class CooldownException
 * @author Edwin ten Brinke <edwin.ten.brinke@extendas.com>
 */
class CooldownException extends JsonBadRequestHttpException
{
    public function __construct(array $message, \DateTime $cooldown, \Throwable $previous = null, int $code = 400, array $headers = [])
    {
        $message['cooldown'] = $cooldown->format(DATE_ISO8601);
        $message['error_code'] = JsonBadRequestHttpException::ERROR_CODE_COOLDOWN;
        parent::__construct($message, $previous, $code, $headers);
    }
}
