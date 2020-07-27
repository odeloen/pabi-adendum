<?php


namespace App\Ods\Iuran\Ext\Midtrans;


use App\Ods\Iuran\Entities\Transactions\Transaction;
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

    private $rawNotification;

    public function __construct(Request $request){
        $this->orderID = $request->order_id;
        $this->statusCode = $request->status_code;
        $this->grossAmount = $request->gross_amount;
        $this->signatureKey = $request->signature_key;

        $this->transactionStatus = $request->transaction_status;
        $this->paymentType = $request->payment_type;
        $this->fraudStatus = $request->fraud_status;

        $this->transactionTime = $request->transaction_time;

        $this->rawNotification = $request->all();
    }

    public function isValid(){
        $serverKey = env('ODS_MIDTRANS_SERVER_KEY');
        $stringToBeHashed = $this->orderID.$this->statusCode.$this->grossAmount.$serverKey;
        $hashToCheck = hash('sha512', $stringToBeHashed);
//        dd(strcmp($this->signatureKey, $hashToCheck));
        if (strcmp($this->signatureKey, $hashToCheck) == 0) return true;
        else return false;
    }

    public function isCorrectAmount(){
        $transaction = Transaction::find($this->getTransactionID());

        if (!isset($transaction)) return false;

        return $transaction->amount === $this->grossAmount;
    }

    public function isTuition(){
        if (!isset($this->orderID)) return false;

        $temp = explode(Constant::DELIMITER, $this->orderID);
        if (!isset($temp)) return false;
        if (strcmp($temp[0], Constant::IDENTIFIER) != 0) return false;
        if (sizeof($temp) != 2) return false;

        return true;
    }

    public function getTransactionID(){
        if (!$this->isTuition()) return null;

        $temp = explode(Constant::DELIMITER, $this->orderID);

        $midtransTransactionID = $temp[1];
        $midtransTransaction = MidtransTransaction::find($midtransTransactionID);

        $transactionID = $midtransTransaction->transaction_id;

        return $transactionID;
    }

    public function getID(){
        if (!$this->isTuition()) return null;

        $temp = explode(Constant::DELIMITER, $this->orderID);

        return $temp[1];
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

    /**
     * @return false|string
     */
    public function getRawNotification()
    {
        return $this->rawNotification;
    }
}
