<?php

namespace App\Ods\Iuran\Repositories;

use App\Ods\Iuran\Entities\TAC;

class TACRepository
{
    public function findActive(){
        return TAC::find(1);
    }
}
