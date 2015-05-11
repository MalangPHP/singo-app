<?php


namespace App\Modules\User\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class InvalidUsernamePasswordException
 * @package App\Modules\User\Exceptions
 */
class InvalidUsernamePasswordException extends HttpException
{
    /**
     * @param string $message
     */
    public function __construct($message)
    {
        parent::__construct(Response::HTTP_BAD_REQUEST, $message);
    }
}

