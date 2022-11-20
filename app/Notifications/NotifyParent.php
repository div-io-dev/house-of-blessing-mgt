<?php

namespace App\Notifications;

use Arhinful\LaravelMnotify\NotificationDriver\MNotifyMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotifyParent extends Notification
{
    use Queueable;
    public string $message_body;

    public function __construct($message_body)
    {
        $this->message_body = $message_body;
    }

    public function via($notifiable)
    {
        return ['mnotify'];
    }

    public function toMNotify($notifiable)
    {
        return (new MNotifyMessage())->content($this->message_body);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
