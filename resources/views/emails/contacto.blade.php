<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nueva consulta desde la web</title>
</head>
<body style="margin:0;padding:24px;background:#f2f2f2;font-family:Arial,Helvetica,sans-serif;color:#1a1a1a;">

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:620px;margin:0 auto;background:#ffffff;border-radius:10px;overflow:hidden;">

        <tr>
            <td style="background:#253773;padding:20px 28px;">
                <p style="margin:0;color:#ffffff;font-size:18px;font-weight:bold;">
                    Nueva consulta desde la web
                </p>
                <p style="margin:4px 0 0;color:#c9d3f0;font-size:13px;">
                    {{ $datos['solucion'] }}
                </p>
            </td>
        </tr>

        <tr>
            <td style="padding:24px 28px;">
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="font-size:14px;line-height:1.5;">

                    @php
                        $filas = [
                            'Nombre o razón social' => $datos['nombres'],
                            'Correo electrónico' => $datos['email'],
                            'Celular' => $datos['celular'],
                            'Empresa' => $datos['empresa'] ?: 'No indicada',
                            'Solución de interés' => $datos['solucion'],
                        ];
                    @endphp

                    @foreach ($filas as $etiqueta => $valor)
                        <tr>
                            <td style="padding:8px 0;width:38%;color:#6b6b6b;vertical-align:top;">
                                {{ $etiqueta }}
                            </td>
                            <td style="padding:8px 0;font-weight:bold;vertical-align:top;">
                                {{ $valor }}
                            </td>
                        </tr>
                    @endforeach

                </table>

                <p style="margin:22px 0 6px;color:#6b6b6b;font-size:14px;">
                    Descripción del proyecto
                </p>
                <div style="padding:14px 16px;background:#f7f7f7;border-left:3px solid #ffbb10;border-radius:4px;font-size:14px;line-height:1.6;white-space:pre-line;">{{ $datos['proyecto'] }}</div>

                <p style="margin:24px 0 0;padding-top:16px;border-top:1px solid #e5e5e5;color:#9a9a9a;font-size:12px;">
                    Recibido el {{ now()->format('d/m/Y \a \l\a\s H:i') }}
                    @if ($ip) · IP {{ $ip }} @endif
                    <br>
                    Podés responder directamente a este correo: la respuesta le llega a quien completó el formulario.
                </p>
            </td>
        </tr>

    </table>

</body>
</html>
