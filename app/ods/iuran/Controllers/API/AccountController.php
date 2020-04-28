<?php

namespace App\Ods\Iuran\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ods\Auth\Repositories\MemberRepository;
use App\Ods\Iuran\Repositories\AccountRepository;
use App\Ods\Iuran\UseCases\GetAccountListUseCase;

class AccountController extends Controller
{
    private $memberRepository;
    private $accountRepository;

    public function __construct()
    {
        $this->memberRepository = new MemberRepository;
        $this->accountRepository = new AccountRepository;
    }

    public function getAccount() {
        $member = $this->memberRepository->findAuthenticated();
        $useCase = new GetAccountListUseCase($this->accountRepository);
        $response = $useCase->execute($member);
        return response()->json($response);
    }
}
