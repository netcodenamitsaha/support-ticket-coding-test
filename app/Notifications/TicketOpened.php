<?php

namespace App\Notifications;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketOpened extends Notification
{
    use Queueable;

    public $ticket;

    /**
     * Create a new notification instance.
     */
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('New Ticket Opened')
                    ->greeting('Hello Admin,')
                    ->line('A new ticket has been opened by ' . $this->ticket->appliedBy->name)
                    ->line('Ticket Title: ' . $this->ticket->title)
                    ->action('View Ticket', url('/tickets'))
                    ->line('Thank you for using our application!');
    }
}