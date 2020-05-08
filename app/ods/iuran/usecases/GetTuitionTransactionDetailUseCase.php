<?php

namespace App\Ods\Iuran\UseCases;

use App\Ods\Core\Requests\UseCaseResponse;

class GetTuitionTransactionDetailUseCase
{
    private $transactionRepository;
    private $userRepository;
    private $accountRepository;

    public function __construct($transactionRepository, $userRepository, $accountRepository)
    {
        $this->transactionRepository = $transactionRepository;
        $this->userRepository = $userRepository;
        $this->accountRepository = $accountRepository;
    }

    public function execute($transactionID)
    {                
        try {
            $transaction = $this->transactionRepository->find($transactionID);

            $user = $this->userRepository->find($transaction->user_id);
            $transaction->user = $user;

            $account = $this->accountRepository->findByMember($user);
            $transaction->account = $account[0];
            
            $transaction->tuition = $transaction->tuition;
    
            $transaction->method = $transaction->getPaymentMethod();    
        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal mendapatkan transaksi terkait');
            return $response;
        }

        $data = [
            'transaction' => $transaction,            
        ];

        $response = new UseCaseResponse($data, null, null);

        return $response;
    }
}
