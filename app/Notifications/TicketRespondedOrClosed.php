<?php

namespace App\Notifications;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketRespondedOrClosed extends Notification
{
    use Queueable;

    public $ticket;
    public $type;

    /**
     * Create a new notification instance.
     */
    public function __construct(Ticket $ticket, $type)
    {
        $this->ticket = $ticket;
        $this->type = $type;
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
        $subject = $this->type == 'response' ? 'Ticket Responded' : 'Ticket Closed';
        $message = $this->type == 'response' ? 'Your ticket has been responded to by an admin.' : 'Your ticket has been closed by an admin.';

        return (new MailMessage)
                    ->subject($subject)
                    ->greeting('Hello ' . $this->ticket->appliedBy->name . ',')
                    ->line($message)
                    ->line('Ticket Title: ' . $this->ticket->title)
                    ->action('View Ticket', url('/tickets'))
                    ->line('Thank you for using our application!');
    }
}
