<?php


namespace App\Ods\Iuran\Ext\Midtrans;


use Illuminate\Http\Request;

class MidtransNotification
{
    private $orderID;
    private $statusCode;
    private $grossAmount;
    private $signatureKey;

    private $transactionStatus;
    private $paymentType;
    private $fraudStatus;

    private $transactionTime;
    private $receivedTime;

    public function __construct(Request $request){
        $this->orderID = $request->order_id;
        $this->statusCode = $request->status_code;
        $this->grossAmount = $request->gross_amount;
        $this->signatureKey = $request->signature_key;

        $this->transactionStatus = $request->transaction_status;
        $this->paymentType = $request->payment_type;
        $this->fraudStatus = $request->fraud_status;

        $this->transactionTime = $request->transaction_time;
    }

    /**
     * @return mixed
     */
    public function getOrderID()
    {
        return $this->orderID;
    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @return mixed
     */
    public function getGrossAmount()
    {
        return $this->grossAmount;
    }

    /**
     * @return mixed
     */
    public function getSignatureKey()
    {
        return $this->signatureKey;
    }

    /**
     * @return mixed
     */
    public function getTransactionStatus()
    {
        return $this->transactionStatus;
    }

    /**
     * @return mixed
     */
    public function getPaymentType()
    {
        return $this->paymentType;
    }

    /**
     * @return mixed
     */
    public function getFraudStatus()
    {
        return $this->fraudStatus;
    }

    /**
     * @return mixed
     */
    public function getTransactionTime()
    {
        return $this->transactionTime;
    }

    /**
     * @return mixed
     */
    public function getReceivedTime()
    {
        return $this->receivedTime;
    }
}
