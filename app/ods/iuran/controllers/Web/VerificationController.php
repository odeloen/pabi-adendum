<?php

namespace App\Ods\Iuran\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ods\Core\Entities\Alert;
use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Iuran\Entities\Transactions\Transaction;
use App\Ods\Iuran\Entities\User\Admin;
use App\Ods\Auth\Repositories\AdminRepository;
use App\Ods\Auth\Repositories\MemberRepository;
use App\Ods\Iuran\Repositories\TransactionRepository;
use App\Ods\Iuran\UseCases\GetTuitionVerificationListUseCase;
use App\Ods\Iuran\UseCases\AcceptTuitionVerificationUseCase;
use App\Ods\Iuran\UseCases\DeclineTuitionVerificationListUseCase;
use Illuminate\Support\Facades\Validator;
use App\Ods\Iuran\UseCases\DeclineTuitionVerificationUseCase;

class VerificationController extends Controller
{
    private $adminRepository;

    public function __construct()
    {
        $this->adminRepository = new AdminRepository;
        view()->addNamespace('Ods\Iuran', app_path('Ods/Iuran/Views'));
    }

    public function getTuitionVerificationPage(){
        $transactionRepository = new TransactionRepository;
        $memberRepository = new MemberRepository;

        $useCase = new GetTuitionVerificationListUseCase($transactionRepository, $memberRepository);
        $response = $useCase->execute();

        Alert::fromResponse($response);

        return view('Ods\Iuran::admin.verification', $response->data);
    }

    public function acceptTuitionVerification(Request $request){
        $validator = Validator::make($request->all(), [
            'transaction_id' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error("Error", "Isian kurang lengkap");
            return back()->withErrors($validator)->withInput();
        }

        $transactionRepository = new TransactionRepository;

        $useCase = new AcceptTuitionVerificationUseCase($transactionRepository);
        $response = $useCase->execute($request->transaction_id);

        Alert::fromResponse($response);

        return redirect()->route('admin.tuition.verification.list');
    }

    public function declineTuitionVerification(Request $request){
        $validator = Validator::make($request->all(), [
            'transaction_id' => 'required',
            'comment' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error("Error", "Isian kurang lengkap");
            return back()->withErrors($validator)->withInput();
        }

        $transactionRepository = new TransactionRepository;

        $useCase = new DeclineTuitionVerificationUseCase($transactionRepository);
        $response = $useCase->execute($request->transaction_id, $request->comment);

        Alert::fromResponse($response);

        return redirect()->route('admin.tuition.verification.list');
    }
}
