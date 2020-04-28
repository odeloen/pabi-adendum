<?php

namespace App\Ods\Iuran\UseCases;

use App\Ods\Core\Requests\UseCaseResponse;
use Illuminate\Support\Facades\DB;
use App\Ods\Notification\Usecases\CreateNotificationUseCase;

class DeclineTuitionVerificationUseCase
{
    private $transactionRepository;

    public function __construct($transactionRepository){
        $this->transactionRepository = $transactionRepository;
    }

    public function execute($transactionID, $comment)
    {
        DB::beginTransaction();
        try {
            $transaction = $this->transactionRepository->find($transactionID);
            $transaction->decline($comment);
            $transaction->save();
        } catch (\Throwable $th) {
            DB::rollBack();
            $response = UseCaseResponse::createErrorResponse('Gagal menolak pembayaran');
            return $response;
        }

        try {
            $createNotif = new CreateNotificationUseCase();
            $createNotif->execute($transaction->user_id, "Pembayaran iuran ditolak", "Pembayaran iuran untuk tahun ".$transaction->tuition->year." ditolak");
        } catch (\Throwable $th) {
            DB::rollBack();
            $response = UseCaseResponse::createErrorResponse('Gagal menolak pembayaran');
            return $response;
        }
        DB::commit();

        $response = UseCaseResponse::createMessageResponse('Berhasil menolak pembayaran');

        return $response;
    }
}
