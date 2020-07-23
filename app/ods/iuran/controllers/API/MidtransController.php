<?php


namespace App\Ods\Iuran\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Ods\Iuran\Ext\Midtrans\MidtransNotification;
use App\Ods\Iuran\Ext\Midtrans\MidtransPort;
use Illuminate\Http\Request;

class MidtransController extends Controller
{
    public function handleNotification(Request $request){
        $notification = new MidtransNotification($request);

        $midtransPort = new MidtransPort();

        $response = $midtransPort->processNotification($notification);

        return response()->json($response);
    }
}
