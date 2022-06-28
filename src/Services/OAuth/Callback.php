<?php

namespace Vandar\Sso\Services\OAuth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class Callback
{
    private $response;

    public function authorizationCode(): CallBack
    {
        $request = request();
        $state = $request->session()->pull('state');

        throw_unless(strlen($state) > 0 && $state === $request->state, InvalidArgumentException::class);

        $this->response = Http::asForm()->post(
        config('sso.server_uri').'/oauth/token',
        [
            'grant_type' => 'authorization_code',
            'client_id' => config('sso.client_id'),
            'client_secret' => config('sso.client_secret'),
            'redirect_uri' => config('sso.redirect_uri'),
            'code' => $request->code,
        ]);

        return $this;
    }

     public function clientCredentials(): CallBack
    {
        $this->response = Http::asForm()->post(
        config('sso.server_uri').'/oauth/token',
        [
            'grant_type' => 'client_credentials',
            'client_id' => config('sso.client_id'),
            'client_secret' => config('sso.client_secret'),
            'scope' => config('sso.scope'),
        ]);

        return $this;
    }

    public function json(): array
    {
        return $this->response->json();
    }
}
