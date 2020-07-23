<?php

namespace App\Ods\Iuran\UseCases;

use App\Ods\Core\Requests\UseCaseResponse;
use App\Ods\Iuran\Repositories\TransactionRepository;
use Illuminate\Support\Facades\DB;

class AcceptTuitionVerificationUseCase
{
    private $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function execute($transactionID)
    {
        try {
            $transaction = $this->transactionRepository->find($transactionID);
        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal menemukan pembayaran');
            return $response;
        }

        if (!isset($transaction)){
            $response = UseCaseResponse::createErrorResponse('Pembayaran tidak ditemukan');
            return $response;
        }

        $transaction->accept();

        DB::connection('odssql')->beginTransaction();
        try {
            $this->transactionRepository->save($transaction);
        } catch (\Throwable $th) {
            DB::connection('odssql')->rollBack();
            $response = UseCaseResponse::createErrorResponse('Gagal menerima pembayaran');
            return $response;
        }
        DB::connection('odssql')->commit();

        $response = UseCaseResponse::createMessageResponse('Berhasil menerima pembayaran');

        return $response;
    }
}
