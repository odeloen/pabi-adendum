<?php

namespace App\Ods\Iuran\UseCases;

use App\Ods\Core\Requests\UseCaseResponse;
use App\Ods\Iuran\Entities\PaymentMethods\DirectTransferMethod;
use App\Ods\Iuran\Entities\PaymentMethods\PaymentMethod;
use App\Ods\Iuran\Entities\PaymentMethods\VirtualAccountMethod;

class GetMemberTuitionStatusUseCase
{
    private $tuitionRepository;
    private $transactionRepository;

    public function __construct($memberRepository, $tuitionRepository, $transactionRepository)
    {

    }

    public function execute($member)
    {
        $status = null;

        try {
            $tuitions = $this->tuitionRepository->all();
            $transactions = $this->transactionRepository->findByMember($member);
            // $tuitions = $useCaseRequest->tuitions;
            // $transactions = $member->tuitions;
        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal mendapatkan status iuran member');
            return $response;
        }

        if ($transactions != null && $transactions->count() == $tuitions->count()){
            $status = true;
        } else {
            $status = false;
        }

        $data = [
            'status' => $status,
        ];

        $response = new UseCaseResponse($data, null, null);

        return $response;
    }
}
