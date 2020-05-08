<?php

namespace App\Ods\Iuran\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ods\Iuran\Entities\User\Admin;
use App\Ods\Iuran\UseCases\UpdateTACUseCase;
use Illuminate\Support\Facades\Validator;
use App\Ods\Core\Entities\Alert;
use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Iuran\Entities\TAC;
use App\Ods\Iuran\Repositories\AdminRepository;

class TACController extends Controller
{    

    public function __construct()
    {        
        view()->addNamespace('Ods\Iuran', app_path('Ods/Iuran/Views'));
    }

    public function updateTAC(Request $request){
        $validator = Validator::make($request->all(), [
            'tac' => 'required|file',
        ]);

        if ($validator->fails()) {
            Alert::error("Error", "Isian kurang lengkap");            
            return back()->withErrors($validator)->withInput();
        }        
        
        $tac = TAC::getInstance();
        $file = $request->file('tac');

        $useCase = new UpdateTACUseCase();
        $response = $useCase->execute($tac, $file);

        Alert::fromResponse($response);

        return back();
    }
}
