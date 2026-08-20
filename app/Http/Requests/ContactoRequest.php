<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactoRequest extends FormRequest
{
    /**
     * Catalogo de soluciones. Tiene que coincidir con SOLUCIONES del
     * archivo contactoSchema.js: si el front ofrece una opcion que el
     * back no acepta, el formulario falla sin motivo aparente.
     */
    public const SOLUCIONES = [
        'Fabricación metalmecánica',
        'Montaje industrial',
        'Mantenimiento y reparación',
        'Ingeniería y diseño',
        'Soluciones de arrastre MasterMover',
        'Soluciones de movilidad TENTE',
        'Otro',
    ];

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombres' => ['required', 'string', 'min:3', 'max:120'],
            'email' => ['required', 'email:rfc,dns', 'max:120'],
            'celular' => ['required', 'string', 'min:6', 'max:25', 'regex:/^[0-9+\s()\-]+$/'],
            'empresa' => ['nullable', 'string', 'max:120'],
            'solucion' => ['required', 'string', Rule::in(self::SOLUCIONES)],
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

            'solucion.required' => 'Selecciona la solución que buscas.',
            'solucion.in' => 'Esa opción no está disponible.',

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
