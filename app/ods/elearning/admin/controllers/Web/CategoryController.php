<?php

namespace App\Ods\Elearning\Admin\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Ods\Core\Entities\Alert;
use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Elearning\Admin\Repositories\CategoryRepository;
use App\Ods\Elearning\Admin\Usecases\CreateCategoryUseCase;
use App\Ods\Elearning\Admin\Usecases\DeleteCategoryUseCase;
use App\Ods\Elearning\Admin\Usecases\GetCategoryListUseCase;
use App\Ods\Elearning\Admin\Usecases\UpdateCategoryUseCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    private $categoryRepository;

    public function __construct()
    {
        $this->categoryRepository = new CategoryRepository();
    }

    public function list(){
        $useCaseRequest = new UseCaseRequest();
        $useCaseRequest->categoryRepository = $this->categoryRepository;

        $useCase = new GetCategoryListUseCase();
        $response = $useCase->execute($useCaseRequest);

        Alert::fromResponse($response);

        return view('Ods\Elearning\Admin::category.list', $response->data);
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error("Error", "Isian kurang lengkap");
            return back()->withErrors($validator)->withInput();
        }

        $useCaseRequest = new UseCaseRequest($request);
        $useCaseRequest->categoryRepository = $this->categoryRepository;

        $useCase = new CreateCategoryUseCase();
        $response = $useCase->execute($useCaseRequest);

        Alert::fromResponse($response);

        return back();
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(),[
            'category_id' => 'required',
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error("Error", "Isian kurang lengkap");
            return back()->withErrors($validator)->withInput();
        }

        $useCaseRequest = new UseCaseRequest($request);
        $useCaseRequest->categoryRepository = $this->categoryRepository;

        $useCase = new UpdateCategoryUseCase();
        $response = $useCase->execute($useCaseRequest);

        Alert::fromResponse($response);

        return back();
    }

    public function delete(Request $request){
        $validator = Validator::make($request->all(),[
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error("Error", "Isian kurang lengkap");
            return back()->withErrors($validator)->withInput();
        }

        $useCaseRequest = new UseCaseRequest($request);
        $useCaseRequest->categoryRepository = $this->categoryRepository;

        $useCase = new DeleteCategoryUseCase();
        $response = $useCase->execute($useCaseRequest);

        Alert::fromResponse($response);

        return back();
    }
}
