<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

// SuscripcionMailable - v1.0 (30/10/2026): correo para confirmar la suscripcion al boletin.
// El remitente es el configurado en MAIL_FROM_ADDRESS / MAIL_FROM_NAME del .env.
class SuscripcionMailable extends Mailable
{
    use SerializesModels;

    public function __construct(public string $urlConfirmar, public string $urlBaja)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Confirma tu suscripción al boletín del Repositorio Digital');
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.suscripcion-confirmar',
            with: ['urlConfirmar' => $this->urlConfirmar, 'urlBaja' => $this->urlBaja],
        );
    }
}
