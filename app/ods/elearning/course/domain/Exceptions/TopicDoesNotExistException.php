<?php


namespace App\Ods\Elearning\Course\Domain\Exceptions;

use Throwable;

class TopicDoesNotExistException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = "Topik tidak dapat ditemukan";
        parent::__construct($message, $code, $previous);
    }

}
