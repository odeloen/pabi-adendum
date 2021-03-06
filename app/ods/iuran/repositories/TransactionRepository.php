<?php

namespace App\Ods\Iuran\Repositories;

use App\Ods\Iuran\Entities\Payables\Tuition;
use App\Ods\Iuran\Entities\Transactions\Transaction;
use App\Ods\Iuran\Ext\Midtrans\MidtransPaymentVerificator;
use App\Ods\Iuran\Ext\Midtrans\MidtransTransaction;
use App\Ods\Iuran\Ext\Midtrans\MidtransTransactionRepository;
use App\Ods\Utils\Guzzle\KeuanganAPITrait;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Throw_;
use Ramsey\Uuid\Uuid;

class TransactionRepository
{
    use KeuanganAPITrait;

    /**
     * @param $transactionID
     * @return Transaction
     */
    public function find($transactionID){
        return Transaction::find($transactionID);
    }

    public function findByMember($member){
        $transactions = Transaction::where('user_id', $member->id)
                        ->where('payable_type', 'Tuition')
                        ->get();
        foreach ($transactions as $transaction) {
            $transaction->created_at_string = $transaction->getCreatedAt();
            $transaction->updated_at_string = $transaction->getUpdatedAt();
            $transaction->receipt_date_string = $transaction->getReceiptDate();
            $transaction->verified_date_string = $transaction->getVerifiedDate();
        }

        // dd($transactions);

        return $transactions;
    }

    public function findByMemberAndTuition($member, $tuitionID){
        $transaction = Transaction::where('user_id', $member->id)
                                    ->where('payable_type', 'Tuition')
                                    ->where('payable_id', $tuitionID)
                                    ->first();
        return $transaction;
    }

    /**
     * @param Transaction $transaction
     * @return String
     * @throws \Throwable
     */
    public function insert(Tuition $tuition, Transaction $transaction){
        DB::connection('odssql')->beginTransaction();

        $transaction->save();

        $midtransTransactionRepository = new MidtransTransactionRepository();

        try {
            $token = $midtransTransactionRepository->insert($tuition, $transaction);
        } catch (\Throwable $throwable) {
            DB::connection('odssql')->rollBack();
            throw $throwable;
        }

        if (!isset($token)) {
            DB::connection('odssql')->rollBack();
            throw new \Exception();
        }

        DB::connection('odssql')->commit();

        return $token;
    }

    public function save(Transaction $transaction){
        $transaction->save();
    }

    public function findHistory(){
        $transactions = Transaction::where('payable_type', 'Tuition')
                        ->where('status', 1)
                        ->get();

        foreach ($transactions as $transaction) {
            $transaction->created_at_string = $transaction->getCreatedAt();
            $transaction->updated_at_string = $transaction->getUpdatedAt();
            $transaction->receipt_date_string = $transaction->getReceiptDate();
            $transaction->verified_date_string = $transaction->getVerifiedDate();
        }

        return $transactions;
    }

    public function findForVerification(){
        $transactions = Transaction::where('payable_type', 'Tuition')
                        ->whereNull('verified_date')
                        ->where('receipt_path', '<>', '')
                        ->whereNull('comment')
                        ->get();

        foreach ($transactions as $transaction) {
            $transaction->created_at_string = $transaction->getCreatedAt();
            $transaction->updated_at_string = $transaction->getUpdatedAt();
            $transaction->receipt_date_string = $transaction->getReceiptDate();
            $transaction->verified_date_string = $transaction->getVerifiedDate();
        }

        return $transactions;
    }

    public function notifyKeuangan($transaction){
        $response = $this->guzzle('GET', 'member/user/'.$member->id, []);

        $response = json_decode($response->getBody()->getContents(), true);

        $data = $response['data'];

        $registeredNumber =  $data[0]['card_no'];

        $response = $this->guzzleKeuangan('GET', 'get_dokter.php?noanggota='.$registeredNumber, []);
        $response = json_decode($response->getBody()->getContents(), true);

        $data = $response['data'][0];
        $doctorID = $data['id_dokter'];

        $form = [
            'key' => "CNtVA26CRRqdd293H5rdWq81Opa4UCi2GEYyulTV0zAjIytTDQ86vTvAExKqhU9P",
            'IDDokter' => $doctorID,
            'tglbayar' => $transaction->verified_date,
            'thnbayar' => $transaction->tuition->year,
            'tipepembayaran',
            'nominal' => $transaction->amount,
        ];

        $response = $this->guzzleKeuangan('POST', 'app.php', $form);
        $response = json_decode($response->getBody()->getContents(), true);
    }
}
