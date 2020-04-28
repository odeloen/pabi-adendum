<?php

namespace App\Core\Entities;

use App\Ods\Core\Requests\UseCaseResponse;

interface UseCase
{
    /**
     * Run the usecase.
     *
     * @return UseCaseResponse
     */
    public function execute($request);
}
