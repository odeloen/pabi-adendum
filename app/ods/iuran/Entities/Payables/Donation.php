<?php

namespace App\Ods\Iuran\Entities\Payables;

use App\Ods\Utils\Model\OdsModelTrait;
use Illuminate\Database\Eloquent\Model;


class Donation extends Model
{
    protected $connection = 'odssql';

    protected $table = 'donations';
    protected $primaryKey = 'id';
    public $incrementing = true;

    public function transactions(){
        return $this->morphedByMany('App\Ods\Iuran\Entities\Transactions\Transaction', 'payable');
    }

    public function __construct($name, $type, $amount){
        $this->name = $name;
        $this->type= $type;
        $this->amount = $amount;
    }

    public function update($name, $type, $amount){
        $this->name = $name;
        $this->type= $type;
        $this->amount = $amount;
        $this->save();
    }
}
