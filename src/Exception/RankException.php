<?php

namespace App\Exception;

use App\Entity\Cooldown;
use DateTimeInterface;

/**
 * Class RankException
 * @author Edwin ten Brinke <edwin.ten.brinke@extendas.com>
 */
class RankException extends JsonBadRequestHttpException
{
    public function __construct(array $message, \Throwable $previous = null, int $code = 400, array $headers = [])
    {
        $message['error_code'] = JsonBadRequestHttpException::ERROR_CODE_RANK;
        parent::__construct($message, $previous, $code, $headers);
    }
}
