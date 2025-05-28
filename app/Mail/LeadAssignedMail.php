<?php

namespace App\Mail;

use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class LeadAssignedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $lead;

    /**
     * Create a new message instance.
     */
    public function __construct(Lead $lead)
    {
        Log::info('[LeadAssignedMail] __construct triggered');
        Log::info('[LeadAssignedMail] Lead Data:', $lead->toArray());

        $this->lead = $lead;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        Log::info('[LeadAssignedMail] envelope() called');
        return new Envelope(
            subject: 'New Lead Assigned'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        Log::info('[LeadAssignedMail] content() called');
        return new Content(
            view: 'emails.lead_assigned',
            with: [
                'lead' => $this->lead
            ]
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        Log::info('[LeadAssignedMail] attachments() called');
        return [];
    }
}
