<?php

namespace App\Ods\Iuran\Repositories;

use App\Ods\Iuran\Entities\Transactions\Transaction;
use App\Ods\Utils\Guzzle\KeuanganAPITrait;

class TransactionRepository
{
    use KeuanganAPITrait;

    public function create($member, $tuition, $method){
        return Transaction::create($member, $tuition, $method);
    }

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

    public function save($transaction){
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
