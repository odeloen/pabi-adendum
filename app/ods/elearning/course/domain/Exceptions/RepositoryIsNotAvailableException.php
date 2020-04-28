<?php


namespace App\Ods\Elearning\Course\Domain\Exceptions;


use Throwable;

class RepositoryIsNotAvailableException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = "Repository is not available";
        parent::__construct($message, $code, $previous);
    }

}
