<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\EnviaFormularioContacto;
use App\Http\Requests\ContactoRequest;
use Illuminate\Http\RedirectResponse;

/**
 * Formulario de contacto general: es el unico que le pide al visitante
 * elegir la solucion de interes, porque puede llegar desde cualquier
 * pagina del sitio.
 */
class ContactoController extends Controller
{
    use EnviaFormularioContacto;

    public function store(ContactoRequest $request): RedirectResponse
    {
        $datos = $request->validated();

        return $this->enviarContacto(
            $datos,
            $request->ip(),
            $datos['solucion'],
        );
    }
}
