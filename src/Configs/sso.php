<?php

return [
    'server_uri' => env('SSO_SERVER_URI', 'http://172.21.0.1:8008'),
    'client_id' => env('SSO_CLIENT_ID'),
    'client_secret' => env('SSO_CLIENT_SECRET'),
    'redirect_uri' => env('SSO_REDIRECT_URI'),
    'response_type' => 'code',
    'scope' => '*',

    'login_by' => env('SSO_LOGIN_BY', 'otp'),
];
