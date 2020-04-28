<?php

namespace App\Ods\Iuran\Entities\PaymentMethods;

class DirectTransferMethod extends PaymentMethod
{
    public function __construct($member)
    {
        $this->id = "DirectTransferMethod";
        $this->name = 'Direct Transfer Mandiri';
        $this->description = '';
        $this->account = "Nomor Rekening PABI";
        $this->accountName = "Rekening PABI";
        $this->accountBankName = "Mandiri";
    }
}
