<?php

namespace App\Ods\Iuran\Entities;

use Illuminate\Database\Eloquent\Model;
use OdsModelTrait;

class TAC extends Model
{
    protected $connection = 'odssql';
    protected $table = 'term_and_conditions';

    private static function findOrCreate($id){
        $obj = static::find($id);
        return $obj ?: new static;
    }

    public static function getInstance(){
        return static::findOrCreate(1);
    }
}
