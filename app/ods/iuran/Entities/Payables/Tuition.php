<?php

namespace App\Ods\Iuran\Entities\Payables;

use App\Ods\Utils\Model\OdsModelTrait;
use Illuminate\Database\Eloquent\Model;


class Tuition extends Model
{
    protected $connection = 'odssql';

    protected $table = 'tuitions';
    protected $primaryKey = 'id';
    public $incrementing = true;

    public function transactions(){
        return $this->morphedByMany('App\Ods\Iuran\Entities\Transactions\Transaction', 'payable');
    }

    public static function create($year, $amount){
        $tuition = new Tuition;
        $tuition->name = 'Iuran Tahun '.$year;
        $tuition->year = $year;
        $tuition->amount = $amount;
        $tuition->type = 1;

        return $tuition;
    }

    public function setAmount($amount){
        $this->amount = $amount;
    }

    public function onPayment(){
        return $this->transaction != null;
    }

    public function change($name, $type, $amount){
        $this->name = $name;
        $this->type= $type;
        $this->amount = $amount;
        $this->save();
    }
}
