<?php


namespace App\Ods\Common\Datetime;


use Carbon\Carbon;

trait DateTimeToString
{
    public function convertTimeToString($timestamp){
        return Carbon::parse($timestamp)->format('d F Y');
    }
}
