<?php


namespace App\Ods\Iuran\Ext\Midtrans;


use App\Ods\Auth\Repositories\MemberRepository;
use App\Ods\Iuran\Entities\Payables\Tuition;
use App\Ods\Iuran\Entities\Transactions\Transaction;
use Ramsey\Uuid\Uuid;

class MidtransTransactionRepository
{
    private $auth;
    private $memberRepository;

    private $baseURL;

    public function __construct()
    {
        $this->auth = 'Basic '.base64_encode(env('ODS_MIDTRANS_SERVER_KEY').':');
        $this->memberRepository = new MemberRepository();

        if (strcmp(env('APP_ENV'), 'local') == 0) $this->baseURL = Constant::MIDTRANS_SANDBOX_BASE_URL;
//        else if (strcmp(env('APP_ENV'), 'production') == 0) $this->baseURL = Constant::MIDTRANS_PRODUCTION_BASE_URL;
    }

    /**
     * @param string $orderID
     * @return mixed
     *
     * @deprecated
     */
    public function findByOrderID(string $orderID){
        // TODO
        $client = new \GuzzleHttp\Client();

        $http_response = $client->request('GET', $this->baseURL.'/v2/'.$orderID.'/status', [
            'headers' => [
                'Accept'        => 'application/json',
                'Content Type' => 'application/json',
                'Authorization' => $this->auth,
            ],
        ]);

        $response = json_decode($http_response->getBody()->getContents(), true);

        return $response;
    }

    public function insert(Tuition $tuition, Transaction $transaction){
        $member = $this->memberRepository->findAuthenticated();

        $midtransTransaction = MidtransTransaction::create($member, $tuition, $transaction);
        $midtransTransaction->save();

        $form = [
            'transaction_details' => $midtransTransaction->getTransactionDetail(),
            'item_details' => $midtransTransaction->getItemDetail(),
            'customer_details' => $midtransTransaction->getCustomerDetail(),
        ];

        $client = new \GuzzleHttp\Client();
        $http_response = $client->request('POST', $this->baseURL.'/snap/v1/transactions', [
            'headers' => [
                'Accept'        => 'application/json',
                'Content Type' => 'application/json',
                'Authorization' => $this->auth,
            ],
            'form_params' => $form
        ]);

        $response = json_decode($http_response->getBody()->getContents(), true);

        return $response['token'];
    }

    public function update(MidtransTransaction $midtransTransaction){
        $midtransTransaction->save();
    }
}
