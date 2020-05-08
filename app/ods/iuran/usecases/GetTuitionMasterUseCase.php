<?php

namespace App\Ods\Iuran\UseCases;

use App\Ods\Core\Requests\UseCaseResponse;

class GetTuitionMasterUseCase
{
    private $tuitionRepository;

    public function __construct($tuitionRepository)
    {
        $this->tuitionRepository = $tuitionRepository;
    }

    public function execute()
    {
        try {
            $tuitions = $this->tuitionRepository->all();
        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal mendapatkan daftar iuran terkait');
            return $response;
        }

        $data = [
            'tuitions' => $tuitions,
        ];

        $response = new UseCaseResponse($data, null, null);

        return $response;
    }
}
