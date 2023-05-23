<?php

return [
    'merchant_id' => env('MERCHANT_ID'),
    'secret_key' => env('SECRET_KEY'),
    'currency_code' => 'MMK',
    'payment_channel' => ['CC', 'MPU', 'QR', 'DPAY', 'IMBANK'],
    'frontend_result_url' => env('RESULT_URL_1'),
    'backend_result_url' => env('RESULT_URL_2'),
    'gateway_url' => [
        'url' => env('BASE_URL'),
        'token' => 'paymentToken',
        'inquiry' => 'paymentInquiry'
    ],
    'locale' => "mm"
];
