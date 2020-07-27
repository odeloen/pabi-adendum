<?php

namespace App\Ods\Iuran\Entities\Transactions;

use App\Ods\Utils\Model\OdsModelTrait;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Transaction extends Model
{
    protected $connection = 'odssql';

    protected $table = 'transactions';
    protected $primaryKey = 'id';
    public $incrementing = true;

    public $created_at_string = null;
    public $updated_at_string = null;
    public $receipt_date_string = null;
    public $verified_date_string = null;

    protected static $statusCollection = [
        ['id' => 0, 'name' => 'progress'],
        ['id' => 1, 'name' => 'confirmed'],
    ];

    public static function statusAll() {
		return collect(static::$statusCollection);
    }

    public function getStatusAtributte($status){
        return collect(static::$statusCollection)
				->where('id', (int)$status)
				->first();
    }

    public function inProgress(){
        return $this->status == 0;
    }

    public function isDone(){
        return $this->status == 1;
    }

    public function accept(){
        $this->status = 1;
        $this->verified_date = Carbon::now();
    }

    public function decline($comment){
        $this->receipt_path = null;
        $this->receipt_date = null;
        $this->comment = $comment;
    }

    public static function create($member, $tuition, $method){
        $transaction = new Transaction;
        $transaction->user_id = $member->id;
        $transaction->payable_type = 'Tuition';
        $transaction->payable_id = $tuition->id;
        $transaction->method = $method;
        $transaction->amount = $tuition->amount;

        return $transaction;
    }

    public function payable(){
        return $this->morphTo('App\Ods\Iuran\Entities\Payables');
    }

    public function tuition(){
        return $this->belongsTo('App\Ods\Iuran\Entities\Payables\Tuition', 'payable_id');
    }

    public function user(){
        return $this->belongsTo('App\Ods\Auth\Entities\Member', 'user_id', 'id');
    }

    public function account(){
        return $this->belongsTo('App\Ods\Iuran\Entities\Accounts\Account', 'account_id', 'id');
    }

    public function getPaymentMethod(){
        $methodName = 'App\Ods\Iuran\Entities\PaymentMethods\\'.$this->method;
        $method = new $methodName($this->user);
        return $method;
    }

    private $receiptDirectory = 'Ods/iuran/receipt/';
    public function setReceipt($receipt){
        if ($this->receipt_path != null && file_exists(storage_path('app/public/'.$this->receipt_path))){
            unlink(storage_path('app/public/'.$this->receipt_path));
        }

        $receiptFile = $receipt;

        $receiptFilePath = $receiptFile->store('public/'.$this->receiptDirectory);
        $tempArray = explode('/', $receiptFilePath);

        $fileName = end($tempArray);
        $filePath = $this->receiptDirectory.$fileName;
        $this->receipt_path = $filePath;
        $this->receipt_date = Carbon::today();
        $this->comment = null;
    }

    public function confirmation(){
        return $this->hasOne('App\Ods\Iuran\Entities\Confirmations\Confirmation');
    }

    public function confirm(){
        $this->status = 1;
        $this->save();
    }

    public function getCreatedAt(){
        return Carbon::parse($this->created_at)->format('d F Y');
    }

    public function getUpdatedAt(){
        return Carbon::parse($this->updated_at)->format('d F Y');
    }

    public function getReceiptDate(){
        return Carbon::parse($this->receipt_date)->format('d F Y');
    }

    public function getVerifiedDate(){
        return Carbon::parse($this->verified_date)->formatLocalized('%d %B %Y');
    }
}
