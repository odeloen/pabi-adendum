<?php

namespace App\Ods\Iuran\Repositories;

use App\Ods\Iuran\Entities\Payables\Tuition;

class TuitionRepository
{
    public function all(){
        return Tuition::all();
    }

    /**
     * @param $tuitionID
     * @return Tuition
     */
    public function find($tuitionID){
        return Tuition::find($tuitionID);
    }

    public function save($tuition){
        $tuition->save();
    }
}
