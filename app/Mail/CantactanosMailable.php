<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CantactanosMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $data; 

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data=$data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('leonatec@hotmail.com', 'Leonardo Gallego'),
            subject: $this->data['asunto'],
        );
    }

    /**
     * Get the message content definition. para agregar contenido a mi correo
     */
    public function content(): Content
    {
         return new Content(
             markdown: $this->data['vista'],
             with: [
                'data' => $this->data,               
            ],
         );
        // return $this->markdown('emails.contactanos', [
        //     'data'=>$this->data
        // ] );
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
