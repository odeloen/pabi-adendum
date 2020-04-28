<?php

namespace App\Ods\Iuran\Repositories;

use App\Ods\Iuran\Entities\PaymentMethods\PaymentMethod;

class PaymentMethodRepository
{
    public function findByMember($member){
        return PaymentMethod::all($member);
    }
}
