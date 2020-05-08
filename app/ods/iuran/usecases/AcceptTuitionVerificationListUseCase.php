<?php

namespace App\Ods\Iuran\UseCases;

use App\Ods\Core\Requests\UseCaseResponse;
use Illuminate\Support\Facades\DB;
use App\Ods\Notification\Usecases\CreateNotificationUseCase;

class AcceptTuitionVerificationListUseCase
{
    private $transactionRepository;

    public function __construct($transactionRepository)
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

        DB::beginTransaction();
        $transaction->accept();
        try {
            $this->transactionRepository->save($transaction);
        } catch (\Throwable $th) {
            DB::rollBack();
            $response = UseCaseResponse::createErrorResponse('Gagal menerima pembayaran');
            return $response;
        }

        try {
            $createNotif = new CreateNotificationUseCase();
            $createNotif->execute($transaction->user_id, "Pembayaran iuran diterima", "Pembayaran iuran untuk tahun ".$transaction->tuition->year." sudah diterima");
        } catch (\Throwable $th) {
            DB::rollBack();
            $response = UseCaseResponse::createErrorResponse('Gagal menerima pembayaran');
            return $response;
        }
        DB::commit();

        $response = UseCaseResponse::createMessageResponse('Berhasil menerima pembayaran');

        return $response;
    }
}
