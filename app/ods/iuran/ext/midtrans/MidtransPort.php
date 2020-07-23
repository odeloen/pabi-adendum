<?php


namespace App\Ods\Iuran\Ext\Midtrans;


use App\Ods\Core\Requests\UseCaseResponse;
use App\Ods\Iuran\Entities\Transactions\Transaction;
use App\Ods\Iuran\Repositories\TransactionRepository;
use App\Ods\Iuran\UseCases\AcceptTuitionVerificationUseCase;

class MidtransPort
{
    private $transactionRepository;
    private $delimiter;

    public function __construct(){
        $this->transactionRepository = new TransactionRepository();
        $this->delimiter = '/;:';
    }

    /**
     * Create transaction at MIDTRANS and get snap token for frontend
     * @param String $transactionID
     * @param int $grossAmount
     * @return String
     */
    public function notifyTransaction(String $transactionID, int $grossAmount){
        $form = [
            'transaction_details' => [
                'order_id' => 'iuran'.$this->delimiter.$transactionID,
                'gross_amount' => $grossAmount
            ],
        ];

        $auth = 'Basic '.base64_encode(env('ODS_MIDTRANS_SERVER_KEY').':');

        $client = new \GuzzleHttp\Client();
        $http_response = $client->request('POST', 'https://app.sandbox.midtrans.com/snap/v1/transactions', [
            'headers' => [
                'Accept'        => 'application/json',
                'Content Type' => 'application/json',
                'Authorization' => $auth,
            ],
            'form_params' => $form
        ]);

        $http_response = json_decode($http_response->getBody()->getContents(), true);

        return $http_response['token'];
    }

    public function processNotification(MidtransNotification $notification){
        $orderID = $notification->getOrderID();
        $statusCode = $notification->getStatusCode();
        $grossAmount = $notification->getGrossAmount();
        $signatureKey = $notification->getSignatureKey();

        if (!$this->isValid($orderID, $statusCode, $grossAmount, $signatureKey)) {
            $response = UseCaseResponse::createErrorResponse('Gagal memvalidasi notifikasi');
            return $response;
        };

        $transactionID = $this->extractTransactionID($orderID);

        if (!isset($transactionID)) {
            $response = UseCaseResponse::createErrorResponse('Transaksi tidak ditemukan');
            return $response;
        }

        $transactionStatus = $notification->getTransactionStatus();
        $type = $notification->getPaymentType();
        $fraudStatus = $notification->getFraudStatus();

        if ($transactionStatus == 'capture') {
            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            if ($type == 'credit_card'){
                if($fraudStatus == 'challenge') $this->processCreditCardFraud($notification);
                else {
                    if ($this->isValidAmount($transactionID, $grossAmount)) {
                        $response = UseCaseResponse::createErrorResponse('Pembayaran tidak sesuai');
                        return $response;
                    };
                    return $this->processCreditCardPayment($transactionID);
                }
            }
        } else if ($transactionStatus == 'settlement') {
            if ($this->isValidAmount($transactionID, $grossAmount)) {
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

    /**
     * @param $notification
     * @return bool
     */
    private function isValid($orderID, $statusCode, $grossAmount, $signatureKey){
        $serverKey = env('ODS_MIDTRANS_SERVER_KEY');
        $stringToBeHashed = $orderID.$statusCode.$grossAmount.$serverKey;
        $hashToCheck = hash('sha512', $stringToBeHashed);

        if (strcmp($signatureKey, $hashToCheck) == 0) return true;
        else return false;
    }

    private function isValidAmount($transactionID, $grossAmount){
        $transaction = Transaction::find($transactionID);

        if (!isset($transaction)) return false;

        return $transaction->amount === $grossAmount;
    }

    private function extractTransactionID($orderID){
        $temp = explode($this->delimiter, $orderID);

        if (strcmp($temp[0], 'iuran') != 0){
            info($orderID.' does not match with the criteria');
            return null;
        }
        if (!isset($temp)) {
            info($orderID.' is null');
            return null;
        }
        if (sizeof($temp) != 2) {
            info($orderID.' length does not match');
            return null;
        }

        $midtransTransactionID = $temp[1];

        $midtransTransaction = MidtransTransaction::find($midtransTransactionID);

        $transactionID = $midtransTransaction->transaction_id;

        return $transactionID;
    }
}
