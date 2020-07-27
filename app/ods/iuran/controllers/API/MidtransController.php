<?php


namespace App\Ods\Iuran\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Ods\Iuran\Ext\Midtrans\MidtransNotification;
use App\Ods\Iuran\Ext\Midtrans\MidtransPaymentVerificator;
use App\Ods\Iuran\Ext\Midtrans\MidtransTransaction;
use Illuminate\Http\Request;

class MidtransController extends Controller
{
    public function handleNotification(Request $request){
        $notification = new MidtransNotification($request);

//        $midtransTransaction = MidtransTransaction::find($notification->getID());
//        $midtransTransaction->addNotification($notification);
//
//        $midtransTransaction->save();
//
//        return response()->json(['data' => $midtransTransaction->getNotifications()]);
        $midtransPort = new MidtransPaymentVerificator();

        $response = $midtransPort->processNotification($notification);

        return response()->json($response);
    }
}
