<?php

namespace App\Ods\Iuran\UseCases;

use App\Ods\Core\Requests\UseCaseResponse;
use App\Ods\Iuran\Policies\MemberRegisteredAtFinancePolicy;

class CreateTuitionTransactionUseCase
{
    private $transactionRepository;
    private $tuitionRepository;

    public function __construct($tuitionRepository, $transactionRepository)
    {
        $this->tuitionRepository = $tuitionRepository;
        $this->transactionRepository = $transactionRepository;
    }

    public function execute($member, $tuitionID, $method){
        $policy = new MemberRegisteredAtFinancePolicy;
        // if (!$policy->isAllowed($member)){
        //     $response = UseCaseResponse::createErrorResponse('Anggota belum terdaftar pada sistem keuangan, silahkan hubungi admin');
        //     return $response;
        // }

        try {
            $tuition = $this->tuitionRepository->find($tuitionID);
            $transaction = $this->transactionRepository->create($member, $tuition, $method);
            $this->transactionRepository->save($transaction);
        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal membuat transaksi');
            return $response;
        }

        $response = UseCaseResponse::createMessageResponse('Berhasil membuat transaksi');

        return $response;
    }
}
