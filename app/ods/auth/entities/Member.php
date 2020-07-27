<?php

namespace App\Ods\Auth\Entities;

use App\Ods\Core\Entities\OdsUser;
use App\Ods\Utils\Model\OdsModelTrait;

/**
 * Class Member
 * @package App\Ods\Auth\Entities
 * @mixin \Eloquent
 *
 * Properties
 * @property String $firstname
 * @property String $lastname
 * @property String $fullname
 * @property String $email
 * @property String $phonenumber
 */
class Member extends OdsUser
{
    protected $connection = 'odssql';
    protected $table = 'users';

    public static function getInstance(){
        return Member::find(3);
    }

    public function accounts(){
        return $this->hasMany('App\Ods\Iuran\Entities\Accounts\Account', 'user_id', 'id');
    }

    public function tuitions(){
        return $this->hasMany('App\Ods\Iuran\Entities\Transactions\Transaction', 'user_id', 'id');
        // return $this->hasManyThrough('App\Ods\Iuran\Entities\Transactions\Transaction', 'App\Ods\Iuran\Entities\Accounts\Account', 'user_id')
        //             ->where('transactions.payable_type', '=', 'Tuition');
    }

    public function donations(){
        return $this->hasMany('App\Ods\Iuran\Entities\Transactions\Transaction')
                    ->join('users', 'transactions.user_id', '=', 'user.id')
                    ->where('transaction.user_id', '=', $this->id)
                    ->where('transaction.payable_type', '=', 'Donation');
    }

    public static function create($id, $username, $email){
        $member = new Member;
        $member->id = $id;
        $member->username = $username;
        $member->email = $email;

        return $member;
    }
}
