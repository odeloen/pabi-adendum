<?php

namespace App\Ods\Iuran\Repositories;

use App\Ods\Iuran\Entities\Accounts\Account;
use App\Ods\Utils\Guzzle\KodigAPITrait;
use Illuminate\Support\Collection;


class AccountRepository
{
    use KodigAPITrait;

    public function findByMember($member) : Collection
    {
        // return $member->accounts;
        
        $response = $this->guzzle('GET', 'member/user/'.$member->id, []);
        
        $response = json_decode($response->getBody()->getContents(), true);
        
        $data = $response['data'];

        $accounts = [];

        $account = new Account();
        $account->name =  $data[0]['bank_pemilik'];
        $account->number = $data[0]['bank_no_rekening'];
        $account->bank_name = $data[0]['bank_nama'];

        $accounts[] = $account;        
        $accounts = collect($accounts);        

        return $accounts;
    }
}
