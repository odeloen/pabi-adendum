<?php

namespace App\Ods\Elearning\Admin\Usecases;


use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Core\Requests\UseCaseResponse;

class UpdateCategoryUseCase 
{
    public function execute($useCaseRequest) : UseCaseResponse
    {
        $categoryRepository = $useCaseRequest->categoryRepository;
        $categoryID = $useCaseRequest->userRequest->category_id;
        $name = $useCaseRequest->userRequest->name;

        $category = $categoryRepository->update($categoryID, $name);

        try {
            $categoryRepository->save($category);
        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal mengubah kategori');
            return $response;
        }

        $response = UseCaseResponse::createMessageResponse('Berhasil mengubah kategori');

        return $response;
    }
}
