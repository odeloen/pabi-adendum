<?php

namespace App\Ods\Iuran\Controllers\Api;

use App\Ods\Auth\Repositories\MemberRepository;
use App\Ods\Iuran\Repositories\PaymentMethodRepository;
use App\Ods\Iuran\UseCases\GetPaymentMethodListUseCase;

class PaymentMethodController {
    private $memberRepository;
    private $paymentRepository;

    public function __construct()
    {
        $this->memberRepository = new MemberRepository;
        $this->paymentRepository = new PaymentMethodRepository;
    }

    public function getPaymentMethods() {
        $member = $this->memberRepository->findAuthenticated();
        $useCase = new GetPaymentMethodListUseCase($this->paymentRepository);
        $response = $useCase->execute($member);
        return response()->json($response);
    }
}