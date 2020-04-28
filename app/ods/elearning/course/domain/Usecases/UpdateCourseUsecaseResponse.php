<?php


namespace App\ods\elearning\Course\Domain\Usecases;


class UpdateCourseUsecaseResponse
{
    private $message = "Berhasil menyimpan perubahan";

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }


}
