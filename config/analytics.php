<?php

return [
    'view_id' => env('ANALYTICS_VIEW_ID'),

    'service_account_credentials_json' => storage_path('app/your-credentials-file.json'),

    'cache_lifetime_in_minutes' => 60 * 24,

    'cache' => [
        'store' => 'file',
    ],
];

