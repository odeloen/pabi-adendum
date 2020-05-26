<?php


namespace App\Ods\Elearning\Course\Domain\Application\Material;


use App\Ods\Core\Requests\UseCaseResponse;
use App\Ods\Elearning\Course\Domain\Repositories\IMaterialRepository;

class UpdateMaterialUsecase
{
    /**
     * @var IMaterialRepository $materialRepository
     */
    private $materialRepository;


    /**
     * UpdateMaterialUsecase constructor.
     * @param IMaterialRepository $materialRepository
     */
    public function __construct(IMaterialRepository $materialRepository){
        $this->materialRepository = $materialRepository;
    }

    public function execute(String $materialID, String $name, String $description = null, bool $public, $content){
        try {
            $material = $this->materialRepository->findByID($materialID);
        } catch (\Exception $exception){
            return UseCaseResponse::createErrorResponse("Gagal mencari topik");
        }

        if (!isset($material)) return UseCaseResponse::createErrorResponse("Materi tidak ditemukan");

        $material->update(
            $name,
            $description,
            $content,
            $public
        );

        try {
            $this->materialRepository->update($material);
        } catch (\Exception $exception) {
            return UseCaseResponse::createErrorResponse("Gagal menyimpan materi");
        }

        return UseCaseResponse::createMessageResponse("Berhasil menyimpan materi");
    }
}
