<?php

namespace App\Ods\Iuran\UseCases;

use App\Ods\Core\Requests\UseCaseResponse;
use App\Ods\Iuran\Entities\Payables\Tuition;
use App\Ods\Iuran\Policies\TuitionUniqueYearPolicy;
use App\Ods\Iuran\Repositories\TuitionRepository;

class CreateTuitionMasterUseCase
{
    private $tuitionRepository;

    public function __construct(TuitionRepository $tuitionRepository)
    {
        $this->tuitionRepository = $tuitionRepository;
    }

    public function execute($year, $amount){
        $tuition = Tuition::create($year, $amount);

        $policy = new TuitionUniqueYearPolicy($this->tuitionRepository, $tuition);

        try {
            if (!$policy->isAllowed($tuition)){
                $response = UseCaseResponse::createErrorResponse('Sudah ada iuran dengan tahun '.$tuition->year);
                return $response;
            }
        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal tersambung dengan iuran');
            return $response;
        }

        try {
            $this->tuitionRepository->save($tuition);
        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal membuat iuran');
            return $response;
        }

        $response = UseCaseResponse::createMessageResponse('Berhasil membuat iuran');

        return $response;
    }
}
