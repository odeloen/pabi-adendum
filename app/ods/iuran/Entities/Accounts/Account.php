<?php

namespace App\Ods\Iuran\Entities\Accounts;

use App\Ods\Utils\Model\OdsModelTrait;
use Illuminate\Database\Eloquent\Model;


class Account extends Model
{
    protected $connection = 'odssql';

    public function user(){
        return $this->belongsTo('App\Ods\Iuran\Entities\User\Member', 'user_id');
    }

    public function transactions(){
        return $this->hasMany('App\Ods\Iuran\Entities\Transactions\Transaction');
    }

    public static function create($number, $name, $bankName){
        $account = new Account;
        $account->number = $number;
        $account->name = $name;
        $account->bank_name = $bankName;

        return $account;
    }
}
