# <p>SSO Vandar</p>

## requirements

- PHP v8.1
- Laravel v9.2

## Installation
```
composer require vandar/sso
```

## Documentation
<h4>Example:</h4>
<p>edit: routes/web.php</p>

```
<?php

use Illuminate\Support\Facades\Route;
use Vandar\Sso\SsoService;

Route::get('/auth/redirect', function () {
    return SsoService::redirect();
});

Route::get('/auth/callback', function () {
    return SsoService::authorizationCode();
});
```

<p>edit: app/Http/Kernel.php</p>

```
add to protected $routeMiddleware:

'vandar' => \Vandar\Sso\Middleware\VandarAuthenticate::class,

```
<br />
<br />
<br />
<strong>php artisan vendor:publish </strong>
<p>and select sso </p>
<p>you can set configs:</p>

```
server_uri
client_id
client_secret
redirect_uri
response_type
scope
login_by
```

<p>or set in env:</p>

```
SSO_SERVER_URI=https://accounts.vandara.io
SSO_CLIENT_ID=id
SSO_CLIENT_SECRET=secret
SSO_REDIRECT_URI=https://escrow.vandar.io/auth/callback
```
