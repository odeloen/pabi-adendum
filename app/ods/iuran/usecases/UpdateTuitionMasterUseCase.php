<?php

namespace App\Ods\Iuran\UseCases;

use App\Ods\Core\Requests\UseCaseResponse;
use App\Ods\Iuran\Repositories\TuitionRepository;

class UpdateTuitionMasterUseCase
{
    private $tuitionRepository;

    public function __construct(TuitionRepository $tuitionRepository)
    {
        $this->tuitionRepository = $tuitionRepository;
    }

    public function execute($tuitionID, $amount){
        try {
            $tuition = $this->tuitionRepository->find($tuitionID);
        } catch (\Exception $exception){
            $response = UseCaseResponse::createErrorResponse('Gagal mencari iuran');
            return $response;
        }

        if (!isset($tuition)){
            $response = UseCaseResponse::createErrorResponse('Iuran tidak ditemukan');
            return $response;
        }

        $tuition->setAmount($amount);

        try {
            $this->tuitionRepository->save($tuition);
        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal memperbarui iuran');
            return $response;
        }

        $response = UseCaseResponse::createMessageResponse('Berhasil memperbarui iuran');

        return $response;
    }
}
