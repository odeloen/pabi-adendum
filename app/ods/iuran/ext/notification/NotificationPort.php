<?php


namespace App\Ods\Iuran\Ext\Notification;


use App\Ods\Core\Requests\UseCaseResponse;
use App\Ods\Notification\Usecases\CreateNotificationUseCase;

class NotificationPort
{
    public function createNotification($userID, $year){
        $createNotif = new CreateNotificationUseCase();
        $createNotif->execute($userID, "Pembayaran iuran diterima", "Pembayaran iuran untuk tahun ".$year." sudah diterima");
    }
}
