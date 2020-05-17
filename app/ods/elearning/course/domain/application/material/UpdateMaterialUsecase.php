<?php


namespace App\Ods\Elearning\Course\Domain\Application\Material;


use App\Ods\Core\Requests\UseCaseResponse;
use App\Ods\Elearning\Course\Domain\Entities\Material;
use App\Ods\Elearning\Course\Domain\Repositories\IMaterialRepository;
use phpDocumentor\Reflection\Types\Boolean;

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

    public function execute(String $materialID, String $name, String $description, Boolean $public, String $type, $content){
        try {
            $material = $this->materialRepository->findByID($materialID);
        } catch (\Exception $exception){
            return UseCaseResponse::createErrorResponse("Gagal mencari topik");
        }

        if (!isset($material)) return UseCaseResponse::createErrorResponse("Materi tidak ditemukan");

        $material->setName($name);
        $material->setDescription($description);
        $material->setPublic($public);
        $material->setType($type);
        $material->setContent($content);

        $material->markUpdated();

        try {
            $this->materialRepository->insert($material);
        } catch (\Exception $exception) {
            return UseCaseResponse::createErrorResponse("Gagal menyimpan materi");
        }

        return UseCaseResponse::createMessageResponse("Berhasil menyimpan materi");
    }
}
