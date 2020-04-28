<?php

namespace App\Ods\Iuran\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Iuran\Entities\Payables\Tuition;
use App\Ods\Iuran\Entities\Transactions\Transaction;
use App\Ods\Iuran\Entities\User\Member;
use App\Ods\Iuran\UseCases\CreateTuitionTransactionUseCase;
use App\Ods\Iuran\UseCases\GetMemberTuitionListUseCase;
use App\Ods\Iuran\UseCases\UpdateTuitionTransactionUseCase;
use Illuminate\Support\Facades\Validator;
use App\Ods\Core\Entities\Alert;
use App\Ods\Auth\Repositories\MemberRepository;
use App\Ods\Iuran\Repositories\AccountRepository;
use App\Ods\Iuran\Repositories\PaymentMethodRepository;
use App\Ods\Iuran\Repositories\TransactionRepository;
use App\Ods\Iuran\Repositories\TuitionRepository;
use App\Ods\Iuran\UseCases\UploadReceiptUseCase;

class MemberWebController extends Controller
{
    private $memberRepository;

    public function __construct()
    {
        $this->memberRepository = new MemberRepository;
        view()->addNamespace('Ods\Iuran', app_path('ods/iuran/views'));
    }

    public function getTuitionListPage(){
        $member = $this->memberRepository->findAuthenticated();

        $tuitionRepository = new TuitionRepository;
        $transactionRepository = new TransactionRepository;
        $paymentMethodRepository = new PaymentMethodRepository;
        $accountRepository = new AccountRepository;

        $useCase = new GetMemberTuitionListUseCase($tuitionRepository, $transactionRepository, $paymentMethodRepository, $accountRepository);
        $response = $useCase->execute($member);

        Alert::fromResponse($response);

        return view('Ods\Iuran::member.list', $response->data);
    }

    public function createTuitionTransaction(Request $request){
        $validator = Validator::make($request->all(), [
            'tuition_id' => 'required',
            'account_id' => 'required',
            'method_id' => 'required',
        ]);

        if ($request->term == null || !$request->term){
            Alert::error("Error", "Harap setujui syarat dan ketentuan");
            return back()->withErrors($validator)->withInput();
        }

        if ($validator->fails()) {
            Alert::error("Error", "Isian kurang lengkap");
            return back()->withErrors($validator)->withInput();
        }

        $member = $this->memberRepository->findAuthenticated();
        $tuitionID = $request->tuition_id;
        $method = $request->method_id;

        $useCaseRequest = new UseCaseRequest($request, $member);
        $useCaseRequest->transaction = new Transaction();
        $useCaseRequest->tuition = Tuition::find($request->tuition_id);

        $tuitionRepository = new TuitionRepository;
        $transactionRepository = new TransactionRepository;

        $useCase = new CreateTuitionTransactionUseCase($tuitionRepository, $transactionRepository);
        $response = $useCase->execute($member, $tuitionID, $method);

        Alert::fromResponse($response);

        return redirect()->route('member.tuition.list');
    }

    public function updateTuitionTransaction(Request $request){
        $validator = Validator::make($request->all(), [
            'transaction_id' => 'required',
            // 'account_id' => 'required',
            'method_id' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error("Error", "Isian kurang lengkap");
            return back()->withErrors($validator)->withInput();
        }

        $member = $this->memberRepository->findAuthenticated();

        $useCaseRequest = new UseCaseRequest($request, $member);
        $useCaseRequest->transaction = Transaction::find($request->transaction_id);

        $useCase = new UpdateTuitionTransactionUseCase();
        $response = $useCase->execute($useCaseRequest);

        Alert::fromResponse($response);

        return redirect()->route('member.tuition.list');
    }

    public function uploadReceipt(Request $request){
        $validator = Validator::make($request->all(), [
            'transaction_id' => 'required',
            'receipt' => 'required|file|image|mimes:jpeg,png,jpg',
        ]);

        if ($validator->fails()) {
            Alert::error("Error", "Isian kurang lengkap");
            return back()->withErrors($validator)->withInput();
        }

        $transactionID = $request->transaction_id;
        $receipt = $request->file('receipt');

        $transactionRepository = new TransactionRepository;

        $useCase = new UploadReceiptUseCase($transactionRepository);
        $response = $useCase->execute($transactionID, $receipt);

        Alert::fromResponse($response);

        return redirect()->route('member.tuition.list');
    }
}
