<?php


namespace App\Ods\Elearning\Course\Domain\Exceptions;


use Throwable;

class MaterialDoesNotExistException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = "Materi tidak dapat ditemukan";
        parent::__construct($message, $code, $previous);
    }

}
