<?php

namespace App\Ods\Iuran\UseCases;

use App\Ods\Core\Requests\UseCaseResponse;

class UpdateTuitionTransactionUseCase 
{
    public function execute($useCaseRequest){
        $transaction = $useCaseRequest->transaction;
        $transaction->account_id = $useCaseRequest->userRequest->account_id;
        $transaction->method = $useCaseRequest->userRequest->method_id;
        
        try {
            $transaction->save();
        } catch (\Throwable $th) {            
            $response = UseCaseResponse::createErrorResponse('Gagal memperbarui transaksi');
            return $response;
        }

        $message = 'Berhasil memperbarui transaksi';
        $response = UseCaseResponse::createMessageResponse($message);

        return $response;
    }
}
