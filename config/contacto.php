<?php

return [
    /*
     * Destinatarios del formulario de contacto.
     * Se separan por coma en el .env, sin espacios obligatorios.
     */
    'destinatarios' => array_values(array_filter(array_map(
        'trim',
        explode(',', (string) env('CONTACTO_MAIL_TO', ''))
    ))),

    'copias' => array_values(array_filter(array_map(
        'trim',
        explode(',', (string) env('CONTACTO_MAIL_CC', ''))
    ))),
];