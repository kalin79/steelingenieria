<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactoRequest;
use App\Mail\ContactoRecibido;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    public function store(ContactoRequest $request): RedirectResponse
    {
        $datos = $request->validated();

        // El honeypot no se envia por correo: solo sirve para filtrar bots.
        unset($datos['website']);

        try {
            Mail::to($this->destinatarios())
                ->cc($this->copias())
                ->send(new ContactoRecibido($datos, $request->ip()));
        } catch (\Throwable $e) {
            // Se registra con los datos completos para poder recuperar el
            // contacto a mano si el correo nunca sale.
            Log::error('Falló el envío del formulario de contacto', [
                'error' => $e->getMessage(),
                'datos' => $datos,
            ]);

            return back()->withInput()->with(
                'error',
                'No pudimos enviar tu mensaje en este momento. Escríbenos directamente a '
                . $this->correoPublico()
                . ' y te respondemos a la brevedad.'
            );
        }

        return back()->with(
            'success',
            'Gracias por escribirnos. Recibimos tu consulta y te vamos a responder a la brevedad.'
        );
    }

    /**
     * Destinatarios internos del formulario.
     *
     * @return array<int, string>
     */
    private function destinatarios(): array
    {
        $destinatarios = config('contacto.destinatarios', []);

        if ($destinatarios !== []) {
            return $destinatarios;
        }

        // Si nadie configuró el .env, cae al correo de la empresa y despues
        // al remitente por defecto, para que el mensaje nunca se pierda.
        $fallback = SiteSetting::current()->email ?: config('mail.from.address');

        return array_values(array_filter([$fallback]));
    }

    /**
     * Copias del formulario.
     *
     * @return array<int, string>
     */
    private function copias(): array
    {
        return config('contacto.copias', []);
    }

    /**
     * Correo que se le muestra al visitante cuando el envío falla.
     *
     * Es el correo público de la empresa a propósito, no los destinatarios
     * internos: esos pueden ser casillas que no conviene exponer en pantalla.
     */
    private function correoPublico(): string
    {
        return SiteSetting::current()->email
            ?: (string) config('mail.from.address');
    }
}
