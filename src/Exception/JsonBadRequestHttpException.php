<?php

namespace App\Exception;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Class JsonBadRequestException
 * @author Edwin ten Brinke <edwin.ten.brinke@extendas.com>
 */
class JsonBadRequestHttpException extends BadRequestHttpException
{
    public const ERROR_CODE_COOLDOWN = 1;
    public const ERROR_CODE_RANK = 2;

    public function __construct($message = null, \Throwable $previous = null, int $code = 400, array $headers = [])
    {
        parent::__construct(json_encode($message), $previous, $code, $headers);
    }
}
