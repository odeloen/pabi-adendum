<?php


namespace App\Ods\Elearning\Course\Domain\Application\Material;


use App\Ods\Core\Requests\UseCaseResponse;
use App\Ods\Elearning\Course\Domain\Repositories\IMaterialRepository;

class GetMaterialDetailUsecase
{
    /**
     * @var IMaterialRepository $materialRepository
     */
    private $materialRepository;

    /**
     * GetMaterialDetailUsecase constructor.
     * @param IMaterialRepository $materialRepository
     */
    public function __construct(IMaterialRepository $materialRepository)
    {
        $this->materialRepository = $materialRepository;
    }

    /**
     * Get material detail with course name, topic name, and lecturer name
     * @param String $materialID
     * @return UseCaseResponse
     */
    public function execute(String $materialID){
        try {
            $material = $this->materialRepository->findByID($materialID);
        } catch (\Exception $exception){
            return UseCaseResponse::createErrorResponse("Gagal mencari materi");
        }

        if (!isset($material)) return UseCaseResponse::createErrorResponse("Materi tidak ditemukan");

        // todo : implementing find course name, topic name, and lecturer name by material id

        $data = [
            'material' => $material
        ];

        return UseCaseResponse::createDataResponse($data);
    }
}
