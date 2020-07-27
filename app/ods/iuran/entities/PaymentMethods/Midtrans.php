<?php


namespace App\Ods\Iuran\Entities\PaymentMethods;


class Midtrans extends PaymentMethod
{
    public function __construct($member)
    {
        $this->id = "Midtrans";
        $this->name = 'Midtrans';
        $this->description = 'Third party';
        $this->account = '';
        $this->accountName = "";
        $this->accountBankName = "";
    }
}
