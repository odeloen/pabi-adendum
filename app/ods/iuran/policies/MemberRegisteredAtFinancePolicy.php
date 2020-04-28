<?php

namespace App\Ods\Iuran\Policies;

use App\Ods\Utils\Guzzle\KodigAPITrait;
use App\Ods\Utils\Guzzle\KeuanganAPITrait;


class MemberRegisteredAtFinancePolicy
{    
    use KodigAPITrait;
    use KeuanganAPITrait;

    public function isAllowed($member)
    {
        $response = $this->guzzle('GET', 'member/user/'.$member->id, []);
        
        $response = json_decode($response->getBody()->getContents(), true);
        
        $data = $response['data'];        
        
        $registeredNumber =  $data[0]['card_no'];                

        $response = $this->guzzleKeuangan('GET', 'get_dokter.php?noanggota='.$registeredNumber, []);
        $response = json_decode($response->getBody()->getContents(), true);
        
        try {
            $data = $response['data'][0];        
        } catch (\Throwable $th) {
            return false;
        }

        return true;
    }    
}
