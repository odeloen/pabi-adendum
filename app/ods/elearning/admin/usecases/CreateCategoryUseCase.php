<?php

namespace App\Ods\Elearning\Admin\Usecases;


use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Core\Requests\UseCaseResponse;

class CreateCategoryUseCase 
{
    public function execute($useCaseRequest) : UseCaseResponse
    {
        $categoryRepository = $useCaseRequest->categoryRepository;
        $name = $useCaseRequest->userRequest->name;

        $category = $categoryRepository->create($name);

        try {
            $categoryRepository->save($category);
        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal membuat kategori');
            return $response;
        }

        $response = UseCaseResponse::createMessageResponse('Berhasil membuat kategori');

        return $response;
    }
}
