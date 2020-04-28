<?php

namespace App\Ods\Elearning\General\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Ods\Core\Entities\Alert;
use App\Ods\Elearning\General\Repositories\AcceptedMaterialRepository;
use App\Ods\Elearning\General\Usecases\GetGeneralMaterialDetailUseCase;
use App\Ods\Elearning\General\Usecases\GetGeneralMaterialListUseCase;
use App\Ods\Elearning\Lecturer\Repositories\LecturerRepository;

class MaterialController extends Controller
{
    public function __construct()
    {
        view()->addNamespace('Ods\Elearning\General', app_path('Ods/elearning/general/views/'));
    }

    public function list(){
        $materialRepository = new AcceptedMaterialRepository;

        $useCase = new GetGeneralMaterialListUseCase($materialRepository);
        $response = $useCase->execute();

        Alert::fromResponse($response);

        return view('Ods\Elearning\General::article.list', $response->data);
    }

    public function show($articleID){
        $materialRepository = new AcceptedMaterialRepository;
        $lecturerRepository = new LecturerRepository;

        $useCase = new GetGeneralMaterialDetailUseCase($lecturerRepository, $materialRepository);
        $response = $useCase->execute($articleID);

        Alert::fromResponse($response);

        return view('Ods\Elearning\General::article.show', $response->data);
    }
}
