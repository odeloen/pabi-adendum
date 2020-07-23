<?php


namespace App\Ods\Iuran\Ext\Midtrans;


use Illuminate\Database\Eloquent\Model;

/**
 * Class MidtransTransaction
 * @package App\Ods\Iuran\Ext\Midtrans
 * @mixin \Eloquent
 *
 * Properties
 * @property $id
 * @property $transaction_id
 */
class MidtransTransaction extends Model
{
    protected $connection = 'odssql';

    protected $table = 'midtrans_transactions';
    protected $primaryKey = 'id';
    public $incrementing = false;

    public $timestamps = false;
}
