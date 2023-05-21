<?php

return [
    'merchant_id' => 'JT02',
    'secret_key' => '72B8F060B3B923E580411200068A764610F61034AE729AB9EF20CAFF93AFA1B9',
    'currency_code' => 'MMK',
    'payment_channel' => ['CC', 'MPU', 'QR', 'DPAY', 'IMBANK'],
    'frontend_result_url' => 'https://example.com/payment',
    'backend_result_url' => 'https://example.com/payment',
    'gateway_url' => [
        'url' => 'https://sandbox-pgw.2c2p.com/payment/4.1/',
        'token' => 'paymentToken',
        'inquiry' => 'paymentInquiry'
    ],
    'locale' => "mm"
];