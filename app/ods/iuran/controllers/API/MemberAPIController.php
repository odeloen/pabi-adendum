<?php

namespace App\Ods\Iuran\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Auth\Repositories\MemberRepository;
// use App\Ods\Elearning\Member\Repositories\MemberRepository;
use App\Ods\Iuran\Entities\Payables\Tuition;
use App\Ods\Iuran\UseCases\GetMemberTuitionListUseCase;
use Illuminate\Support\Facades\Validator;
use App\Ods\Iuran\Entities\Transactions\Transaction;
use App\Ods\Iuran\UseCases\CreateTuitionTransactionUseCase;
use App\Ods\Iuran\UseCases\UpdateTuitionTransactionUseCase;
use App\Ods\Iuran\UseCases\UploadReceiptUseCase;
use App\Ods\Iuran\Entities\TAC;
use App\Ods\Iuran\Repositories\AccountRepository;
use App\Ods\Iuran\Repositories\PaymentMethodRepository;
use App\Ods\Iuran\Repositories\TACRepository;
use App\Ods\Iuran\Repositories\TransactionRepository;
use App\Ods\Iuran\Repositories\TuitionRepository;
use App\Ods\Iuran\UseCases\GetTACUseCase;
use App\Ods\Iuran\UseCases\GetMemberTuitionStatusUseCase;

class MemberAPIController extends Controller
{
    private $memberRepository;
    private $tuitionRepository;
    private $transactionRepository;

    public function __construct()
    {
        $this->memberRepository = new MemberRepository;
        $this->tuitionRepository = new TuitionRepository;
        $this->transactionRepository = new TransactionRepository;
    }

    public function getStatus(){
        $member = $this->memberRepository->findAuthenticated();

        $useCaseRequest = new UseCaseRequest(null, $member);
        $useCaseRequest->tuitions = Tuition::all();

        $useCase = new GetMemberTuitionStatusUseCase(
            $this->memberRepository,
            $this->tuitionRepository,
            $this->transactionRepository
        );
        $response = $useCase->execute($useCaseRequest);

        return response()->json($response);
    }

    public function getTuitionList(){
        $member = $this->memberRepository->findAuthenticated();

        $useCaseRequest = new UseCaseRequest(null, $member);
        $useCaseRequest->tuitions = Tuition::all();

        $paymentMethodRepository = new PaymentMethodRepository;
        $accountRepository = new AccountRepository;

        $useCase = new GetMemberTuitionListUseCase(
            $this->tuitionRepository,
            $this->transactionRepository,
            $paymentMethodRepository,
            $accountRepository
        );
        $response = $useCase->execute($member);

        return response()->json($response);
    }

    public function createTuitionTransaction(Request $request){
        $validator = Validator::make($request->all(), [
            'tuition_id' => 'required',
            'account_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 409);
        }

        // $member = $this->memberRepository->findAuthenticated();
        $member = $this->memberRepository->find($request->account_id);
        $tuitionID = $request->tuition_id;
        $method = 'Midtrans';

        $useCase = new CreateTuitionTransactionUseCase(
            $this->tuitionRepository,
            $this->transactionRepository
        );
        $response = $useCase->execute($member, $tuitionID, $method);

        return response()->json($response);
    }

    public function updateTuitionTransaction(Request $request){
        $validator = Validator::make($request->all(), [
            'transaction_id' => 'required',
            'account_id' => 'required',
            'method_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 409);
        }

        // $member = $this->memberRepository->findAuthenticated();
        $member = $this->memberRepository->find($request->account_id);
        $useCaseRequest = new UseCaseRequest($request, $member);
        $useCaseRequest->transaction = Transaction::find($request->transaction_id);

        $useCase = new UpdateTuitionTransactionUseCase();
        $response = $useCase->execute($useCaseRequest);

        return response()->json($response);
    }

    public function uploadReceipt(Request $request){
        $validator = Validator::make($request->all(), [
            'transaction_id' => 'required',
            'account_id' => 'required',
            'receipt' => 'required|file|image|mimes:jpeg,png,jpg',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 409);
        }

        $member = $this->memberRepository->find($request->account_id);

        $useCase = new UploadReceiptUseCase($this->transactionRepository);
        $response = $useCase->execute($request->transaction_id, $request->receipt);

        return response()->json($response);
    }

    public function getTAC(){
        $member = $this->memberRepository->findAuthenticated();

        $useCaseRequest = new UseCaseRequest(null, $member);
        $useCaseRequest->tac = TAC::getInstance();

        $tacRepository = new TACRepository;

        $useCase = new GetTACUseCase($tacRepository);
        $response = $useCase->execute($useCaseRequest);

        return response()->json($response);
    }
}
