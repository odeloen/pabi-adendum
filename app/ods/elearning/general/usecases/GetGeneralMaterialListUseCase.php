<?php

namespace App\Ods\Elearning\General\Usecases;


use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Core\Requests\UseCaseResponse;

class GetGeneralMaterialListUseCase
{
    private $materialRepository;

    public function __construct($materialRepository)
    {
        $this->materialRepository = $materialRepository;
    }

    public function execute() : UseCaseResponse
    {
        $materials = $this->materialRepository->findPublic();
        try {

        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse("Tidak dapat menemukan materi-materi terkait");
            return $response;
        }

        $data = [
            'materials' => $materials,
        ];

        $response = UseCaseResponse::createDataResponse($data);

        return $response;
    }
}
