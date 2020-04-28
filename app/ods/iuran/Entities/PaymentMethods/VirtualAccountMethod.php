<?php

namespace App\Ods\Iuran\Entities\PaymentMethods;

class VirtualAccountMethod extends PaymentMethod
{
    public function __construct($member)
    {
        $this->id = "VirtualAccountMethod";
        $this->name = 'Virtual Account Mandiri';
        $this->description = '';
        $this->account = 'Rekening Virtual Mandiri';
        $this->accountName = "Rekening Virtual PABI";
        $this->accountBankName = "Mandiri";
    }
}
