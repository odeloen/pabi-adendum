<?php

namespace App\Ods\Iuran\UseCases;

use App\Ods\Core\Requests\UseCaseResponse;

class GetTACUseCase
{
    private $tacRepository;

    public function __construct($tacRepository)
    {
        $this->tacRepository = $tacRepository;
    }

    public function execute()
    {

        try {
            $tac = $this->tacRepository->findActive();
        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal mendapatkan syarat dan ketentuan');
            return $response;
        }

        $data = [
            'tac' => $tac,
        ];

        $response = new UseCaseResponse($data, null, null);

        return $response;
    }
}
