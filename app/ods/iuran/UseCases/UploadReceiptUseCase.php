<?php

namespace App\Ods\Iuran\UseCases;

use App\Ods\Core\Requests\UseCaseResponse;
use Carbon\Carbon;

class UploadReceiptUseCase
{
    private $transactionRepository;

    public function __construct($transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function execute($transactionID, $receipt){
        $transaction = $this->transactionRepository->find($transactionID);

        $transaction->setReceipt($receipt);

        // $transaction = $useCaseRequest->transaction;

        // if ($transaction->receipt_path != null && file_exists(storage_path('app/public/'.$transaction->receipt_path))){
        //     unlink(storage_path('app/public/'.$transaction->receipt_path));
        // }

        // $receiptFile = $useCaseRequest->userRequest->file('receipt');

        // $receiptFilePath = $receiptFile->store('public/'.$this->receiptDirectory);
        // $tempArray = explode('/', $receiptFilePath);

        // $fileName = end($tempArray);
        // $filePath = $this->receiptDirectory.$fileName;
        // $transaction->receipt_path = $filePath;
        // $transaction->receipt_date = Carbon::today();
        // $transaction->comment = null;
        // $transaction->save();

        try {
            $this->transactionRepository->save($transaction);
        } catch (\Throwable $th) {
            if ($transaction->receipt_path != null && file_exists(storage_path('app/public/'.$transaction->receipt_path))){
                unlink(storage_path('app/public/'.$transaction->receipt_path));
            }
            $response = UseCaseResponse::createErrorResponse('Gagal menggunggah bukti pembayaran');
            return $response;
        }

        $message = 'Berhasil menggunggah bukti pembayaran';
        $response = UseCaseResponse::createMessageResponse($message);

        return $response;
    }
}
