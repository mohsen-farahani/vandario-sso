<?php

namespace Vandar\Sso\Services\OAuth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class Redirect
{
    public static function handle(): RedirectResponse
    {
        request()->session()->put('state', $state = Str::random(40));

        $query = http_build_query([
            'client_id' => config('sso.client_id'),
            'redirect_uri' => config('sso.redirect_uri'),
            'response_type' => config('sso.response_type'),
            'scope' => config('sso.scope'),
            'state' => $state,
            'login_by' => config('sso.login_by'),
        ]);

        return redirect(config('sso.server_uri').'/oauth/authorize?'.$query);
    }
}
