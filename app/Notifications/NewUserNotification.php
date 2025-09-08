<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class NewUserNotification extends Notification
{
    use Queueable;

    protected User $user;
    protected $delayTime;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $user, $delayTime = null)
    {
        $this->user = $user;
        $this->delayTime = $delayTime;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('New user registered: ' . $this->user->name)
                    ->line('Delay time: ' . $this->delayTime . ' seconds');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
