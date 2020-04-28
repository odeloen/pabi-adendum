<?php

namespace App\Ods\Elearning\Admin\Usecases;


use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Core\Requests\UseCaseResponse;

class DeleteCommentUseCase 
{
    public function execute($useCaseRequest) : UseCaseResponse
    {
        $commentableRepository = $useCaseRequest->commentebleRepository;
        $commentableID = $useCaseRequest->userRequest->commentable_id;

        $commentable = $commentableRepository->find($commentableID);
        $commentable->setComment(null);

        try {
            $commentableRepository->save($commentable);
        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal memberi komentar');
            return $response;
        }

        $response = UseCaseResponse::createMessageResponse('Berhasil memberi komentar');

        return $response;
    }
}
