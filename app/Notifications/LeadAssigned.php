<?php

namespace App\Notifications;

use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
class LeadAssigned extends Notification implements ShouldQueue
{
    use Queueable;

    protected Lead $lead;

    /**
     * Create a new notification instance.
     */
    public function __construct(Lead $lead)
    {
        $this->lead = $lead;
    }

    /**
     * Get the notification's delivery channels.
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
        
        $url = config('app.url') . '/leads/' . $this->lead->id;
        return (new MailMessage)
            ->subject('New Lead Assigned')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('A new lead has been assigned to you.')
            ->line('Name: ' . $this->lead->name)
            ->line('Email: ' . $this->lead->email)
            ->line('Phone: ' . $this->lead->phone)
            ->action('View Lead', $url)
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification (for database channel).
     */
    public function toArray(object $notifiable): array
    {
        return [
            'lead_id' => $this->lead->id,
            'lead_name' => $this->lead->name,
        ];
    }
}
