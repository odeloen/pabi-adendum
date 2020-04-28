<?php

namespace App\Ods\Notification\Usecases;


use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Core\Requests\UseCaseResponse;
use App\Ods\Auth\Repositories\MemberRepository;
use App\Ods\Notification\Repositories\NotificationRepository;

class CreateNotificationUseCase 
{           
    private $notificationRepository;

    public function __construct(){        
        $this->notificationRepository = new NotificationRepository;
    }
    
    public function execute($receiver, $title, $content)
    {
        $notification = $this->notificationRepository->create($receiver, $title, $content);
        
        $this->notificationRepository->save($notification);        
    }
}
