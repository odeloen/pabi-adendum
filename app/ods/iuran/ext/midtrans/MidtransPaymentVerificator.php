<?php


namespace App\Ods\Iuran\Ext\Midtrans;


use App\Ods\Core\Requests\UseCaseResponse;
use App\Ods\Iuran\Entities\Transactions\Transaction;
use App\Ods\Iuran\Repositories\TransactionRepository;
use App\Ods\Iuran\UseCases\AcceptTuitionVerificationUseCase;

class MidtransPaymentVerificator
{
    private $transactionRepository;

    public function __construct(){
        $this->transactionRepository = new TransactionRepository();
    }

    public function processNotification(MidtransNotification $notification){
        if (!$notification->isTuition()) {
            $response = UseCaseResponse::createErrorResponse('Notifikasi bukan iuran');
            return $response;
        }

        if (!$notification->isValid()) {
            $response = UseCaseResponse::createErrorResponse('Gagal memvalidasi notifikasi');
            return $response;
        };

        $transactionID = $notification->getTransactionID();

        if (!isset($transactionID)) {
            $response = UseCaseResponse::createErrorResponse('Transaksi tidak ditemukan');
            return $response;
        }

        // Save notification
        $midtransTransaction = MidtransTransaction::find($notification->getID());
        $midtransTransaction->addNotification($notification);
        $midtransTransaction->save();

        $transactionStatus = $notification->getTransactionStatus();
        $type = $notification->getPaymentType();
        $fraudStatus = $notification->getFraudStatus();

        if ($transactionStatus == 'capture') {
            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            if ($type == 'credit_card'){
                if($fraudStatus == 'challenge') $this->processCreditCardFraud($notification);
                else {
                    if ($notification->isCorrectAmount()) {
                        $response = UseCaseResponse::createErrorResponse('Pembayaran tidak sesuai');
                        return $response;
                    };
                    return $this->processCreditCardPayment($transactionID);
                }
            }
        } else if ($transactionStatus == 'settlement') {
            if ($notification->isCorrectAmount()) {
                $response = UseCaseResponse::createErrorResponse('Pembayaran tidak sesuai');
                return $response;
            };
            return $this->processSettlement($transactionID);
        }
        else if($transactionStatus == 'pending') $this->processPending($transactionID);
        else if ($transactionStatus == 'deny') $this->processDeny($transactionID);
        else if ($transactionStatus == 'expire') $this->processExpire($transactionID);
        else if ($transactionStatus == 'cancel') $this->processCancel($transactionID);
    }

    private function processCreditCardFraud($transactionID){
        // TODO set payment status in merchant's database to 'Challenge by FDS'
        // TODO merchant should decide whether this transaction is authorized or not in MAP
        echo "Transaction order_id: " . $transactionID ." is challenged by FDS";
    }

    private function processCreditCardPayment($transactionID){
        $usecase = new AcceptTuitionVerificationUseCase($this->transactionRepository);
        $response = $usecase->execute($transactionID);

        echo "Transaction order_id: " . $transactionID ." successfully captured using " . "";
        return $response;
    }

    private function processSettlement($transactionID){
        $usecase = new AcceptTuitionVerificationUseCase($this->transactionRepository);
        $response = $usecase->execute($transactionID);

        return $response;
    }

    private function processPending($transactionID){
        // TODO set payment status in merchant's database to 'Pending'
        echo "Waiting customer to finish transaction order_id: " . $transactionID . " using " . "";
    }

    private function processDeny($transactionID){
        // TODO set payment status in merchant's database to 'Denied'
        echo "Payment using " . "" . " for transaction order_id: " . $transactionID . " is denied.";
    }

    private function processExpire($transactionID){
        // TODO set payment status in merchant's database to 'expire'
        echo "Payment using " . "" . " for transaction order_id: " . $transactionID . " is expired.";
    }

    private function processCancel($transactionID){
        // TODO set payment status in merchant's database to 'Denied'
        echo "Payment using " . "" . " for transaction order_id: " . $transactionID . " is canceled.";
    }
}
