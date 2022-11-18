<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TakePassword extends Notification implements ShouldQueue
{
    use Queueable;
    public $name;
    public $pass;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($admin)
    {
        $this-> name = $admin [0];
        $this-> pass = $admin [1];
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
                    ->line('Assalamualikum.'.$this->name)
                    ->line('Your Password Is: '.$this->pass)
                    ->line('Please Login then Access Our Dashboard.')
                    ->action('Active Acount', url('/admin.login.page/'))
                    ->line('Thank you for using our application!');

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
