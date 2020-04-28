<?php

namespace App\Ods\Elearning\General\Usecases;


use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Core\Requests\UseCaseResponse;

class GetGeneralMaterialDetailUseCase
{
    private $lecturerRepository;
    private $materialRepository;

    public function __construct($lecturerRepository, $materialRepository)
    {
        $this->lecturerRepository = $lecturerRepository;
        $this->materialRepository = $materialRepository;
    }

    public function execute($materialID) : UseCaseResponse
    {
        try {
            $material = $this->materialRepository->find($materialID);
        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse("Tidak dapat menemukan materi terkait");
            return $response;
        }

        try {
            $lecturer = $this->lecturerRepository->findByMaterial($material);
        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse("Tidak dapat menemukan pembuat materi terkait");
            return $response;
        }

        $data = [
            'lecturer' => $lecturer,
            'material' => $material,
        ];

        $response = UseCaseResponse::createDataResponse($data);

        return $response;
    }
}
