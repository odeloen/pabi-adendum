<?php

namespace App\Ods\Iuran\UseCases;

use App\Ods\Core\Requests\UseCaseResponse;
use App\Ods\Iuran\Entities\Transactions\Transaction;
use App\Ods\Iuran\Policies\MemberRegisteredAtFinancePolicy;
use App\Ods\Iuran\Repositories\TransactionRepository;
use App\Ods\Iuran\Repositories\TuitionRepository;

class CreateTuitionTransactionUseCase
{
    private $transactionRepository;
    private $tuitionRepository;

    public function __construct(
        TuitionRepository $tuitionRepository,
        TransactionRepository $transactionRepository
    )
    {
        $this->tuitionRepository = $tuitionRepository;
        $this->transactionRepository = $transactionRepository;
    }

    public function execute($member, $tuitionID, $method){
        $policy = new MemberRegisteredAtFinancePolicy;
//         if (!$policy->isAllowed($member)){
//             $response = UseCaseResponse::createErrorResponse('Anggota belum terdaftar pada sistem keuangan, silahkan hubungi admin');
//             return $response;
//         }

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

        $transaction = $this->transactionRepository->findByMemberAndTuition($member, $tuitionID);

        if (!isset($transaction)) $transaction = Transaction::create($member, $tuition, $method);

        $token = $this->transactionRepository->insert($tuition, $transaction);

        try {

        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal membuat transaksi');
            return $response;
        }

        $data = [
            'token' => $token,
        ];

        $response = UseCaseResponse::createDataResponse($data);

        return $response;
    }
}
