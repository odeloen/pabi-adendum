<?php


namespace App\Ods\Iuran\Ext\Midtrans;


use App\Ods\Auth\Entities\Member;
use App\Ods\Iuran\Entities\Payables\Tuition;
use App\Ods\Iuran\Entities\Transactions\Transaction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

/**
 * Class MidtransTransaction
 * @package App\Ods\Iuran\Ext\Midtrans
 * @mixin \Eloquent
 *
 * Properties
 * @property string $id
 * @property int $transaction_id
 * @property array $notifications
 */
class MidtransTransaction extends Model
{
    /**
     * Properties of eloquent
     */
    protected $connection = 'odssql';

    protected $table = 'midtrans_transactions';
    protected $primaryKey = 'id';
    public $incrementing = false;

    public $timestamps = false;

    /**
     * Properties of the class
     */
    private $transactionDetail;
    private $customerDetail;
    private $itemDetail;

    public static function create(
        Member $member,
        Tuition $tuition,
        Transaction $transaction
    ){
        $midtransTransaction = new MidtransTransaction();
        $midtransTransaction->id = Uuid::uuid4()->toString();
        $midtransTransaction->transaction_id = $transaction->id;

        $midtransTransaction->setTransactionDetail($midtransTransaction->id, $transaction->amount);
        $midtransTransaction->setCustomerDetail($member);
        $midtransTransaction->setItemDetail($tuition, $transaction);

        return $midtransTransaction;
    }

    private function setTransactionDetail($midtransTransactionID, $grossAmount){
        $this->transactionDetail = [
            'order_id' => Constant::IDENTIFIER.Constant::DELIMITER.$midtransTransactionID,
            'gross_amount' => $grossAmount
        ];
    }

    private function setCustomerDetail(Member $member){
        $this->customerDetail = [
            'first_name' => $member->firstname,
            'last_name' => $member->lastname,
            'email' => $member->email,
            'phone' => $member->phonenumber,
        ];
    }

    private function setItemDetail(Tuition $tuition, Transaction $transaction){
        $this->itemDetail = [
            'id' => $tuition->id,
            'price' => $transaction->amount,
            'quantity' => 1,
            'name' => 'Pembayaran '.$tuition->name,
            'brand' => 'PABI Membership',
            'category' => 'Iuran',
            'merchant_name' => 'PABI',
        ];
    }

    /**
     * @return mixed
     */
    public function getTransactionDetail()
    {
        return $this->transactionDetail;
    }

    /**
     * @return mixed
     */
    public function getCustomerDetail()
    {
        return $this->customerDetail;
    }

    /**
     * @return mixed
     */
    public function getItemDetail()
    {
        return $this->itemDetail;
    }

    public function addNotification(MidtransNotification $midtransNotification){
        $oldNotificationsJSON = $this->notifications;
        $oldNotifications = json_decode($oldNotificationsJSON, true);
        $oldNotifications = collect($oldNotifications);

        $nowTimestamp = Carbon::now()->toString();
        $newNotification = [
            $nowTimestamp => $midtransNotification->getRawNotification(),
        ];

        $oldNotifications[] = $newNotification;

        $this->notifications = json_encode($oldNotifications);
    }

    public function getNotifications(){
        return json_decode($this->notifications);
    }
}
