<?php

namespace App\Ods\Elearning\Admin\Usecases;


use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Core\Requests\UseCaseResponse;

class GetCategoryListUseCase 
{
    public function execute($useCaseRequest) : UseCaseResponse
    {
        $categoryRepository = $useCaseRequest->categoryRepository;

        try {
            $categories = $categoryRepository->all();
        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal tersambung dengan kategori');
            return $response;
        }

        $data = [
            'categories' => $categories,
        ];

        $response = UseCaseResponse::createDataResponse($data);

        return $response;
    }
}
