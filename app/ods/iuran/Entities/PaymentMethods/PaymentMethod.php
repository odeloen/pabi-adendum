<?php

namespace App\Ods\Iuran\Entities\PaymentMethods;

class PaymentMethod
{
    public $id = "DirectTransferMethod";
    public $name = 'Direct Transfer Mandiri';
    public $description = '';
    public $account = "Nomor Rekening PABI";
    public $accountName = "";
    public $accountBankName = "";

    public static function all($member){
        $paymentMethods = [
            new DirectTransferMethod($member),
            new VirtualAccountMethod($member),
        ];

        return $paymentMethods;
    }
}
