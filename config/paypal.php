<?php
return [
    'client_id' => env('PAYPAL_CLIENT_ID', 'sandbox_user'),
    'secret' => env('PAYPAL_SECRET', 'sandbox_secret'),
    
    'settings' => [
        'mode' => env('PAYPAL_MODE', 'sandbox'),
        'http.ConnectionTimeOut' => 30,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path('/logs/paypal.log'),
        'log.Loglevel' => 'ERROR'
    ],
];