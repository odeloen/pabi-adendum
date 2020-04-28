<?php

namespace App\Ods\Iuran\UseCases;

use App\Ods\Core\Requests\UseCaseResponse;

class GetAccountListUseCase 
{
    private $accountRepository;

    public function __construct($accountRepository) {
        $this->accountRepository = $accountRepository;
    }

    public function execute($member) {
        $accounts = $this->accountRepository->findByMember($member);

        $data = [
            'accounts' => $accounts,
        ];        

        $response = new UseCaseResponse($data, null, null);

        return $response;
    }
}