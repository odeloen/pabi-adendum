<?php


namespace App\Ods\Elearning\Course\Domain\Application\Material;


use App\Ods\Core\Requests\UseCaseResponse;
use App\Ods\Elearning\Course\Domain\Entities\Material;
use App\Ods\Elearning\Course\Domain\Repositories\IMaterialRepository;
use phpDocumentor\Reflection\Types\Boolean;

class CreateMaterialUsecase
{
    /**
     * @var IMaterialRepository $materialRepository
     */
    private $materialRepository;

    /**
     * CreateMaterialUsecase constructor.
     * @param IMaterialRepository $materialRepository
     */
    public function __construct(IMaterialRepository $materialRepository){
        $this->materialRepository = $materialRepository;
    }

    public function execute(String $topicID, String $name, String $description, String $type, $content, Boolean $public){
        $material = Material::createNewMaterial(
            $topicID,
            $name,
            $description,
            $type,
            $content,
            $public
        );

        try {
            $this->materialRepository->insert($material);
        } catch (\Exception $exception) {
            return UseCaseResponse::createErrorResponse("Gagal menyimpan materi");
        }

        return UseCaseResponse::createMessageResponse("Berhasil menyimpan materi");
    }
}
