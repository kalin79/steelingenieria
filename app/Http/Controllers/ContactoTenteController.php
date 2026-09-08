<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\EnviaFormularioContacto;
use App\Http\Requests\ContactoTenteRequest;
use Illuminate\Http\RedirectResponse;

/**
 * Formulario de la landing TENTE.
 *
 * El type-hint ContactoTenteRequest es lo que dispara la validacion: el
 * container resuelve la clase, corre prepareForValidation, authorize y
 * rules, y recien entonces entra al metodo. Si llegaste a la primera
 * linea del cuerpo, los datos ya son validos.
 */
class ContactoTenteController extends Controller
{
    use EnviaFormularioContacto;

    /**
     * Origen fijo del formulario.
     *
     * No se le pregunta al visitante: ya esta en la pagina de TENTE, asi
     * que el dato se deduce de la ruta. Esto reemplaza al campo "solucion"
     * del formulario general.
     */
    private const ORIGEN = 'Soluciones de movilidad TENTE';

    public function store(ContactoTenteRequest $request): RedirectResponse
    {
        return $this->enviarContacto(
            $request->validated(),
            $request->ip(),
            self::ORIGEN,
        );
    }
}
