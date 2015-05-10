<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default'     => 'main',

    /*
    |--------------------------------------------------------------------------
    | Hashids Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like.
    |
    */

    'connections' => [

        'main'    => [
            'salt'     => env('HASHIDS_MAIN', 's4lt'),
            'length'   => '8',
            'alphabet' => 'ABCDEFGHIJKLMNOPQRSTUVWXZYabcdefghijklmnopqrstuvwxyz1234567890'
        ],

        'event'   => [
            'salt'     => env('HASHIDS_EVENT', 's4lt'),
            'length'   => '16',
            'alphabet' => 'abcdef1234567890'
        ],

        'ticket'  => [
            'salt'     => env('HASHIDS_TICKET', 's4lt'),
            'length'   => '32',
            'alphabet' => 'abcdef1234567890'
        ],

        'invoice' => [
            'salt'     => env('HASHIDS_INVOICE', 's4lt'),
            'length'   => '10',
            'alphabet' => '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ'
        ],

        'email'   => [
            'salt'     => env('HASHIDS_EMAIL', 's4lt'),
            'length'   => '16',
            'alphabet' => '1234567890abcdefghijklmnopqrstuvwxyz'
        ],

    ],

    'model'       => [

        'event.event'          => 'main',
        'event.ticket'         => 'event',
        'event.ticket.peserta' => 'ticket',

        'invoice.invoice'      => 'invoice',

        'email.email'          => 'email',
        'email.attachment'     => 'email',

    ],

];
