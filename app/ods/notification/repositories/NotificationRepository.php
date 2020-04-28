<?php

namespace App\Ods\Notification\Repositories;

use App\Ods\Utils\Guzzle\KodigAPITrait;
use Illuminate\Support\Collection;
use App\Ods\Notitication\Entities\Notification;

class NotificationRepository
{
    use KodigAPITrait;

    public function create($receiver, $title, $content) : Notification
    {
        $notification = new Notification;
        $notification->receiver = $receiver;
        $notification->title = $title;
        $notification->content = $content;
        return $notification;
    }    

    public function save(Notification $notification) : Void
    {
        $form = [
            'subject' => $notification->title,
            'body' => $notification->content,
            'refferer_id' => $notification->receiver,
        ];
        
        $response = $this->guzzle('POST', 'notification/create', $form);
        
        $response = json_decode($response->getBody()->getContents(), true);        
    }
}
