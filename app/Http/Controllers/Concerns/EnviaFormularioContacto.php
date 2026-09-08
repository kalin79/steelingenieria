<?php

namespace App\Http\Controllers\Concerns;

use App\Mail\ContactoRecibido;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * Logica compartida por todos los formularios de contacto del sitio.
 *
 * Cada landing tiene su propio FormRequest (campos distintos) y su propio
 * controlador, pero el envio en si es identico: mismos destinatarios, mismo
 * manejo de error, mismos mensajes flash. Eso vive aca una sola vez.
 *
 * Se usa un trait y no una clase base para no encadenar la jerarquia de
 * controladores: sumar un formulario nuevo es crear un Request y un
 * controlador de ~15 lineas que aplica este trait, sin tocar nada mas.
 */
trait EnviaFormularioContacto
{
    /**
     * @param  array<string, mixed>  $datos  Salida de $request->validated()
     * @param  string  $origen  Etiqueta del formulario: va al asunto y al encabezado del correo
     */
    protected function enviarContacto(array $datos, ?string $ip, string $origen): RedirectResponse
    {
        // El honeypot no se envia por correo: solo sirve para filtrar bots.
        unset($datos['website']);

        try {
            Mail::to($this->destinatarios())
                ->cc($this->copias())
                ->send(new ContactoRecibido($datos, $ip, $origen));
        } catch (\Throwable $e) {
            // Se registra con los datos completos para poder recuperar el
            // contacto a mano si el correo nunca sale.
            Log::error('Falló el envío del formulario de contacto', [
                'origen' => $origen,
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
    protected function destinatarios(): array
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
    protected function copias(): array
    {
        return config('contacto.copias', []);
    }

    /**
     * Correo que se le muestra al visitante cuando el envío falla.
     *
     * Es el correo público de la empresa a propósito, no los destinatarios
     * internos: esos pueden ser casillas que no conviene exponer en pantalla.
     */
    protected function correoPublico(): string
    {
        return SiteSetting::current()->email
            ?: (string) config('mail.from.address');
    }
}
