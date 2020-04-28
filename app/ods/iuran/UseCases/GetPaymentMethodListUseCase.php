<?php

namespace App\Ods\Iuran\UseCases;

use App\Ods\Core\Requests\UseCaseResponse;
use App\Ods\Iuran\Entities\PaymentMethods\DirectTransferMethod;
use App\Ods\Iuran\Entities\PaymentMethods\PaymentMethod;
use App\Ods\Iuran\Entities\PaymentMethods\VirtualAccountMethod;

class GetPaymentMethodListUseCase 
{
    private $paymentMethodRepository;

    public function __construct($paymentMethodRepository)
    {
        $this->paymentMethodRepository = $paymentMethodRepository;
    }

    public function execute($member)
    {
        try {
            $paymentMethods = $this->paymentMethodRepository->findByMember($member);
        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal mendapatkan daftar metode pembayaran');
            return $response;
        }

        $data = [
            'paymentMethods' => $paymentMethods,
        ];        

        $response = new UseCaseResponse($data, null, null);

        return $response;
    }
}
