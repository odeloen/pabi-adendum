<?php


namespace App\Ods\Elearning\Course\Domain\Usecases;


class CreateCourseUsecaseResponse
{
    private $message = "Berhasil menyimpan data";

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }


}
