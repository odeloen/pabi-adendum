<?php

namespace App\Ods\Auth\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ods\Auth\Repositories\MemberRepository;

class MemberController extends Controller
{        
    public function show($userID){
        $memberRepository = new MemberRepository;
        
        $member = $memberRepository->find($userID);

        return response()->json(['member' => $member]);
    }
}
