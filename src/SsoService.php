<?php

namespace Vandar\Sso;

use Illuminate\Http\RedirectResponse;
use Vandar\Sso\Services\OAuth\Callback;
use Vandar\Sso\Services\OAuth\Redirect;

class SsoService
{
    public static function redirect(): RedirectResponse
    {
        return Redirect::handle();
    }

    public static function authorizationCode(): array
    {
        return resolve(Callback::class)->authorizationCode()->json();
    }

    public static function clientCredentials(): array
    {
        return resolve(Callback::class)->clientCredentials()->json();
    }
}
