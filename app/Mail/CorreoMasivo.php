<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CorreoMasivo extends Mailable
{
    use Queueable, SerializesModels;
    public $asunto;
    public $contenido;

    /**
     * Create a new message instance.
     */
    public function __construct($asunto, $contenido)
    {
        //
        $this->asunto = $asunto;
        $this->contenido = $contenido;
    }
    public function build()
    {
        return $this->subject($this->asunto)->view('email.correoPersonalizado');
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->asunto,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.correoPersonalizado',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
