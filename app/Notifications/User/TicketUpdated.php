<?php

namespace App\Notifications\User;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TicketUpdated extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($ticketObj)
    {
        $this->ticketObj = $ticketObj;
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
            ->subject('Vaša požiadavka bola upravená - ' . $this->ticketObj->area->name . ' - PC' . $this->ticketObj->pc )
            ->greeting('Zdravím ' . $notifiable->name)
            ->line('Používateľ '. $this->ticketObj->status()->user->name .' práve upravil stav Vašej požiadavky.')
            ->action('Detail požiadavky', action('Tickets\TicketController@show',[$this->ticketObj->id]))
            ->line('Ďakujeme za používanie ReFa!')
            ->line('V prípade, že ste túto požiadavku nevytvorili Vy, kontaktujte správcu systému.');
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
