<?php

namespace App\Ods\Iuran\UseCases;

use App\Ods\Core\Requests\UseCaseResponse;

class UpdateTuitionMasterUseCase
{
    private $tuitionRepository;

    public function __construct($tuitionRepository)
    {
        $this->tuitionRepository = $tuitionRepository;
    }

    public function execute($tuitionID, $amount){
        $tuition = $this->tuitionRepository->find($tuitionID);
        $tuition->setAmount($amount);

        try {
            $this->tuitionRepository->save($tuition);
        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal memperbarui iuran');
            return $response;
        }

        $message = 'Berhasil memperbarui iuran';
        $response = UseCaseResponse::createMessageResponse($message);

        return $response;
    }
}
