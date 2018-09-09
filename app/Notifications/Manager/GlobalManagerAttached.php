<?php

namespace App\Notifications\Manager;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class GlobalManagerAttached extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($areaObj, $level)
    {
        $this->areaObj = $areaObj;
        $this->level = $level;
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
                    ->subject('Pridaná rola globálneho správcu ' . $this->level . '. úrovne' )
                    ->greeting('Zdravím ' . $notifiable->name)
                    ->line('Bola Vám pridaná rola globálneho správcu ' . $this->level . '. úrovne')
                    ->line('Ďakujeme za používanie ReFa!')
                    ->line('V prípade, že si myslíte že Vám táto rola nepatrí, kontaktujte správcu systému.');
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
