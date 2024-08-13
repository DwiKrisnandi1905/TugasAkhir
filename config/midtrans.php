<?php

return [
    'merchant_id' => env('MIDTRANS_MERCHANT_ID', 'your_merchant_id'),
    'client_key' => env('MIDTRANS_CLIENT_KEY', 'your_client_key'),
    'server_key' => env('MIDTRANS_SERVER_KEY', 'your_server_key'),
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
    'is_sanitized' => env('MIDTRANS_IS_SANITIZED', true),
    'is_3ds' => env('MIDTRANS_IS_3DS', true),
];
