<?php

namespace App\Ods\Iuran\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ods\Iuran\Entities\User\Admin;
use App\Ods\Iuran\UseCases\GetTuitionHistoryUseCase;
use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Core\Entities\Alert;
use App\Ods\Iuran\Entities\Transactions\Transaction;
use App\Ods\Iuran\UseCases\GetTuitionMasterUseCase;
use App\Ods\Iuran\Entities\Payables\Tuition;
use App\Ods\Iuran\UseCases\CreateTuitionMasterUseCase;
use App\Ods\Iuran\UseCases\UpdateTuitionMasterUseCase;
use Illuminate\Support\Facades\Validator;
use App\Ods\Iuran\Entities\TAC;
use App\Ods\Auth\Repositories\AdminRepository;
use App\Ods\Iuran\Repositories\TACRepository;
use App\Ods\Iuran\Repositories\TuitionRepository;
use App\Ods\Iuran\Repositories\TransactionRepository;
use App\Ods\Iuran\Repositories\AccountRepository;
use App\Ods\Auth\Repositories\MemberRepository;
use App\Ods\Iuran\UseCases\GetTACUseCase;

class TuitionController extends Controller
{
    private $adminRepository;

    public function __construct()
    {
        $this->adminRepository = new AdminRepository;
        view()->addNamespace('Ods\Iuran', app_path('Ods/Iuran/Views'));
    }

    public function getHistoryPage(){        
        $transactionRepository = new TransactionRepository;
        $userRepository = new MemberRepository;
        $accountRepository = new AccountRepository;        

        $useCase = new GetTuitionHistoryUseCase($transactionRepository, $userRepository, $accountRepository);
        $response = $useCase->execute();

        Alert::fromResponse($response);

        return view('Ods\Iuran::admin.history', $response->data);
    }

    public function getTuitionMasterPage(){
        $tacRepository = new TACRepository;

        $useCase = new GetTACUseCase($tacRepository);
        $response = $useCase->execute();

        Alert::fromResponse($response);

        $tac = null;
        if (!empty($response->data)){
            $tac = $response->data['tac'];
        }

        $tuitionRepository = new TuitionRepository;

        $useCase = new GetTuitionMasterUseCase($tuitionRepository);
        $response = $useCase->execute();

        Alert::fromResponse($response);
        dd($response);
        return view('Ods\Iuran::admin.master', $response->data)->with('tac', $tac);
    }

    public function createTuition(Request $request){
        $validator = Validator::make($request->all(), [
            'yearPicker' => 'required',
            'amount' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error("Error", "Isian kurang lengkap");
            return back()->withErrors($validator)->withInput();
        }

        $year = $request->yearPicker;
        $amount = $request->amount;

        $tuitionRepository = new TuitionRepository;

        $useCase = new CreateTuitionMasterUseCase($tuitionRepository);
        $response = $useCase->execute($year, $amount);

        Alert::fromResponse($response);

        return redirect()->route('admin.master.list');
    }

    public function updateTuition(Request $request){
        $validator = Validator::make($request->all(), [
            'tuition_id' => 'required',
            'year' => 'required',
            'amount' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error("Error", "Isian kurang lengkap");
            return back()->withErrors($validator)->withInput();
        }

        $tuitionID = $request->tuition_id;
        $amount = $request->amount;

        $tuitionRepository = new TuitionRepository;

        $useCase = new UpdateTuitionMasterUseCase($tuitionRepository);
        $response = $useCase->execute($tuitionID, $amount);

        Alert::fromResponse($response);

        return redirect()->route('admin.master.list');
    }
}
