<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactoRecibido extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public array $datos,
        public ?string $ip = null,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Nueva consulta web: {$this->datos['solucion']}",

            /*
             * El remitente es SIEMPRE una direccion del propio dominio.
             * Poner el correo del visitante en el from hace que el
             * proveedor lo trate como suplantacion de identidad y lo
             * mande a spam o lo rechace de plano, porque ese dominio no
             * autoriza a este servidor a enviar en su nombre.
             *
             * El correo del visitante va en replyTo: al responder desde
             * la bandeja, la respuesta le llega a el.
             */
            replyTo: [
                new Address($this->datos['email'], $this->datos['nombres']),
            ],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contacto',
        );
    }
}
