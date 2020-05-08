<?php

namespace App\Ods\Iuran\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ods\Auth\Repositories\MemberRepository;
use App\Ods\Iuran\Repositories\AccountRepository;
use App\Ods\Iuran\Repositories\TransactionRepository;

use App\Ods\Iuran\UseCases\GetTuitionTransactionDetailUseCase;

class TransactionController extends Controller
{
    public function show($transactionID){
        $transactionRepository = new TransactionRepository;
        $userRepository = new MemberRepository;
        $accountRepository = new AccountRepository;

        $useCase = new GetTuitionTransactionDetailUseCase($transactionRepository, $userRepository, $accountRepository);
        $response = $useCase->execute($transactionID);

        return response()->json($response);
    }    
}
