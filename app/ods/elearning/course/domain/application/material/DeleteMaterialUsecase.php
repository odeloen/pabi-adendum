<?php


namespace App\Ods\Elearning\Course\Domain\Application\Material;


use App\Ods\Core\Requests\UseCaseResponse;
use App\Ods\Elearning\Course\Domain\Repositories\IMaterialRepository;

class DeleteMaterialUsecase
{
    private $materialRepository;

    /**
     * DeleteMaterialUsecase constructor.
     * @param IMaterialRepository $materialRepository
     */
    public function __construct(IMaterialRepository $materialRepository){
        $this->materialRepository = $materialRepository;
    }

    /**
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

        $material->markDeleted();

        try {
            $this->materialRepository->update($material);
        } catch (\Exception $exception) {
            return UseCaseResponse::createErrorResponse("Gagal menyimpan materi");
        }

        if ($material->canBeDeleted()) {
            try {
                $this->materialRepository->delete($material);
            } catch (\Exception $exception) {
                return UseCaseResponse::createErrorResponse("Gagal menghapus materi");
            }
        }

        return UseCaseResponse::createMessageResponse("Berhasil menghapus materi");
    }
}
