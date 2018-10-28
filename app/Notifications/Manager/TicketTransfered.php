<?php

namespace App\Notifications\Manager;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TicketTransfered extends Notification
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
            ->subject('Presunutá požiadavka - ' . $this->ticketObj->area->name . ' - PC' . $this->ticketObj->pc )
            ->greeting('Zdravím ' . $notifiable->name)
            ->line('Presunuli ste požiadavku ' . $this->ticketObj->area->name . ' - PC' . $this->ticketObj->pc . ' na úroveň ' . $this->ticketObj->actualStatus()->level . '.')
            ->action('Detail požiadavky', action('Tickets\TicketController@show',[$this->ticketObj->id]))
            ->line('O ďalších zmenách stavu požiadavky budete informovaní emailom.')
            ->line('Ďakujeme za používanie ReFa!')
            ->line('V prípade, že ste túto zmenu nevykonali kontaktujte správcu systému.');
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
