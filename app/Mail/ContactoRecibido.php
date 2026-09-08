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

    /**
     * @param  array<string, mixed>  $datos  Solo trae los campos que el
     *                                       formulario de origen envio.
     * @param  string  $origen  Etiqueta del formulario. Antes se leia de
     *                          $datos['solucion'], pero no todos los
     *                          formularios tienen ese campo: la landing de
     *                          TENTE, por ejemplo, deduce el origen de la
     *                          ruta. Pasarlo explicito evita que el correo
     *                          reviente con un indice indefinido.
     */
    public function __construct(
        public array $datos,
        public ?string $ip = null,
        public string $origen = 'Formulario web',
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Nueva consulta web: {$this->origen}",

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
