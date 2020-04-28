<?php

namespace App\Ods\Iuran\UseCases;

interface UseCase
{
    /**
     * Run the usecase.
     *
     * @return response
     */
    public function execute($request);
}
