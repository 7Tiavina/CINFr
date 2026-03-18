<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;
use App\Models\Client;
use App\Models\Payment;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public Client $client;
    public Payment $payment;
    public string $pdfPath;

    /**
     * Create a new message instance.
     */
    public function __construct(Client $client, Payment $payment, string $pdfPath)
    {
        $this->client = $client;
        $this->payment = $payment;
        $this->pdfPath = $pdfPath;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmation de commande - CINFr',
            from: config('mail.from.address'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.order_confirmation',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromPath($this->pdfPath)
                ->as('facture_CINFr_' . $this->payment->id . '.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
