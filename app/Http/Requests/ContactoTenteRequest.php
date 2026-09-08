<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Formulario de la landing TENTE.
 *
 * No pide "solucion": el visitante ya esta en la pagina de TENTE, asi que
 * el origen se deduce de la ruta y se agrega en el controlador. Pedirselo
 * seria redundante y era la causa de que este formulario nunca pasara la
 * validacion (el back lo exigia y el front nunca lo enviaba).
 *
 * Los limites son iguales o mas permisivos que los de contactoSchema2.js.
 * Esa es la regla: el backend nunca puede ser mas estricto que el frontend,
 * o el usuario recibe errores que la validacion de cliente no anticipo.
 */
class ContactoTenteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombres' => ['required', 'string', 'min:3', 'max:120'],
            'email' => ['required', 'email:rfc', 'max:150'],
            'celular' => ['required', 'string', 'min:6', 'max:25', 'regex:/^[0-9+\s()\-]+$/'],
            'empresa' => ['required', 'string', 'min:2', 'max:120'],
            'proyecto' => ['required', 'string', 'min:10', 'max:1000'],
            'privacidad' => ['accepted'],

            // Campo trampa: los bots completan todo lo que encuentran.
            // Un humano nunca lo ve, asi que si viene lleno es spam.
            'website' => ['prohibited'],
        ];
    }

    public function messages(): array
    {
        return [
            'nombres.required' => 'Indícanos tu nombre o razón social.',
            'nombres.min' => 'El nombre debe tener al menos 3 caracteres.',

            'email.required' => 'Necesitamos un correo para responderte.',
            'email.email' => 'Ese correo no parece válido.',

            'celular.required' => 'Indícanos un número de contacto.',
            'celular.regex' => 'El número solo puede tener dígitos, espacios y los signos + ( ) -',

            'empresa.required' => 'Indícanos el nombre de tu empresa.',
            'empresa.min' => 'El nombre de la empresa debe tener al menos 2 caracteres.',

            'proyecto.required' => 'Cuéntanos brevemente sobre tu proyecto.',
            'proyecto.min' => 'Describe tu proyecto con al menos 10 caracteres.',
            'proyecto.max' => 'La descripción no puede superar los 1000 caracteres.',

            'privacidad.accepted' => 'Debes aceptar la política de privacidad.',

            'website.prohibited' => 'No pudimos procesar el envío.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'nombres' => trim((string) $this->input('nombres')),
            'email' => mb_strtolower(trim((string) $this->input('email'))),
            'empresa' => trim((string) $this->input('empresa')),
        ]);
    }
}
