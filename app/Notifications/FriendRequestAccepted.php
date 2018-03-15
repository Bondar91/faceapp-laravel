<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;

class FriendRequestAccepted extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Twoje zaproszenie zostało zaakceptowane przez:' . Auth::user()->name);

    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $url = url('users/' . Auth::id());


        if (Auth::user()->sex === 'm') {
            $message  = " przyjął twoje zaproszenie do grona znajomych ";
        }
        elseif (Auth::user()->sex === 'f')
        {
            $message  = " przyjęła twoje zaproszenie do grona znajomych ";
        }

        return [
            'message' => '<a href="'. $url .'">'.Auth::user()->name.'</a>' . $message
        ];
    }
}
