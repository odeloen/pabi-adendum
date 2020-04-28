<?php

namespace App\Ods\Notification\Usecases;


use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Core\Requests\UseCaseResponse;
use App\Ods\Auth\Repositories\MemberRepository;
use App\Ods\Iuran\Repositories\NotificationRepository;

class GetNotificationListUseCase 
{           
    private $notificationRepository;

    public function __construct(){        
        $this->notificationRepository = new NotificationRepository;
    }
    
    public function execute($receiver)
    {
        $notification = $this->notificationRepository->create($receiver, $title, $content);

        try {
            $this->notificationRepository->save($notification);
        } catch (\Throwable $th) {
            throw new Exception("Notifikasi Gagal Dibuat", 1);            
        }
    }
}
