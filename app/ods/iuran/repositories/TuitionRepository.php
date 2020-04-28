<?php

namespace App\Ods\Iuran\Repositories;

use App\Ods\Iuran\Entities\Payables\Tuition;

class TuitionRepository
{
    public function all(){
        return Tuition::all();
    }

    public function find($tuitionID){
        return Tuition::find($tuitionID);
    }

    public function create($year, $amount){
        $tuition = Tuition::create($year, $amount);
        return $tuition;
    }

    public function save($tuition){
        $tuition->save();
    }
}
