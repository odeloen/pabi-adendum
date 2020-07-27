<?php

namespace App\Ods\Iuran\UseCases;

use App\Ods\Core\Requests\UseCaseResponse;
use App\Ods\Iuran\Entities\PaymentMethods\DirectTransferMethod;
use App\Ods\Iuran\Entities\PaymentMethods\PaymentMethod;
use App\Ods\Iuran\Entities\PaymentMethods\VirtualAccountMethod;
use App\Ods\Iuran\Repositories\AccountRepository;
use App\Ods\Iuran\Repositories\TransactionRepository;
use App\Ods\Iuran\Repositories\TuitionRepository;

class GetMemberTuitionListUseCase
{
    private $accountRepository;
    private $tuitionRepository;
    private $transactionRepository;
    private $paymentMethodRepository;

    public function __construct(
        TuitionRepository $tuitionRepository,
        TransactionRepository $transactionRepository,
        $paymentMethodRepository,
        AccountRepository $accountRepository
    ) {
        $this->accountRepository = $accountRepository;
        $this->tuitionRepository = $tuitionRepository;
        $this->transactionRepository = $transactionRepository;
        $this->paymentMethodRepository = $paymentMethodRepository;
    }

    public function execute($member) {
        $transactions = $this->transactionRepository->findByMember($member);
        try {
            $tuitions = $this->tuitionRepository->all();

            $paymentMethods = $this->paymentMethodRepository->findByMember($member);
            $accounts = $this->accountRepository->findByMember($member);
        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal mendapatkan daftar iuran terkait');
            return $response;
        }

        if ($transactions != null){
            foreach ($tuitions as $tuition){
                $transactionOnTuition = $transactions->where('payable_id', $tuition->id)->first();
                if ($transactionOnTuition != null){
                    $transactionOnTuition->account;
                    $transactionOnTuition->method = $transactionOnTuition->getPaymentMethod();
                }
                $tuition->transaction = $transactionOnTuition;
            }
        }

        $data = [
            'member' => $member,
            'accounts' => $accounts,
            'tuitions' => $tuitions,
            'paymentMethods' => $paymentMethods,
        ];

        $response = new UseCaseResponse($data, null, null);

        return $response;
    }
}
