<?php

namespace App\Ods\Iuran\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ods\Iuran\Entities\User\Admin;
use App\Ods\Iuran\UseCases\UpdateTACUseCase;
use Illuminate\Support\Facades\Validator;
use App\Ods\Core\Entities\Alert;
use App\Ods\Iuran\Repositories\PaymentMethodRepository;

class TestController extends Controller
{    

    public function __construct()
    {        
        
    }

    public function test(){
        $paymentMethodRepository = new PaymentMethodRepository;
    }
}
