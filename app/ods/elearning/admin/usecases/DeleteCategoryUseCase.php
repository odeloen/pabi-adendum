<?php

namespace App\Ods\Elearning\Admin\Usecases;


use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Core\Requests\UseCaseResponse;

class DeleteCategoryUseCase 
{
    public function execute($useCaseRequest) : UseCaseResponse
    {
        $categoryRepository = $useCaseRequest->categoryRepository;
        $categoryID = $useCaseRequest->userRequest->category_id;

        $category = $categoryRepository->find($categoryID);

        try {
            $categoryRepository->delete($category);
        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal menghapus kategori');
            return $response;
        }

        $response = UseCaseResponse::createMessageResponse('Berhasil menghapus kategori');

        return $response;
    }
}
