<?php

namespace App\Ods\Iuran\UseCases;

use App\Ods\Core\Requests\UseCaseResponse;

class GetTuitionVerificationListUseCase
{
    private $transactionRepository;
    private $memberRepository;

    public function __construct($transactionRepository, $memberRepository)
    {
        $this->transactionRepository = $transactionRepository;
        $this->memberRepository = $memberRepository;
    }

    public function execute()
    {
        $transactions = $this->transactionRepository->findForVerification();

        if ($transactions != null){
            foreach($transactions as $transaction){
                $transaction->tuition = $transaction->tuition;
                $transaction->user = $this->memberRepository->find($transaction->user_id);
                $transaction->method = $transaction->getPaymentMethod();
            }
        }

        try {

        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal mendapatkan daftar iuran terkait');
            return $response;
        }

        $data = [
            'transactions' => $transactions,
        ];

        $response = new UseCaseResponse($data, null, null);

        return $response;
    }
}
