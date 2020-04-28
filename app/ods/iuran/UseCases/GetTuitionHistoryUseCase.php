<?php

namespace App\Ods\Iuran\UseCases;

use App\Ods\Core\Requests\UseCaseResponse;

class GetTuitionHistoryUseCase
{
    private $transactionRepository;
    private $userRepository;
    private $accountRepository;

    public function __construct($transactionRepository, $userRepository, $accountRepository){
        $this->transactionRepository = $transactionRepository;
        $this->userRepository = $userRepository;
        $this->accountRepository = $accountRepository;
    }
    
    public function execute()
    {                
        $transactions = $this->transactionRepository->findHistory();

        if ($transactions != null){
            foreach($transactions as $transaction){
                $transaction->tuition = $transaction->tuition;
                $transaction->user = $this->userRepository->find($transaction->user_id);
                $transaction->account = $this->accountRepository->findByMember($transaction->user)[0];
                $transaction->method = $transaction->getPaymentMethod();
            }
        }
        
        try {
            
        } catch (\Throwable $th) {                      
            $response = UseCaseResponse::createErrorResponse('Gagal mendapatkan riwayat transaksi');
            return $response;
        }

        $data = [
            'transactions' => $transactions,
        ];
        // dd($data);
        $response = new UseCaseResponse($data, null, null);

        return $response;
    }
}
