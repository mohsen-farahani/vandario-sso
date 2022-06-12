<?php

namespace Vandar\Sso\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Middleware\AuthenticatesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Vandar\Sso\Model\User;

class VandarAuthenticate implements AuthenticatesRequests
{
    /**
     * Handle an incoming request.
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $response = Http::withToken($request->bearerToken(), 'Bearer')
            ->acceptJson()
            ->get(config('sso.server_uri').'/api/v1/users/informations');

        if ($response && $response->status() === 200) {
            $result = $response->json();

            $user = new User();
            $user->setData($result['data']);
            Auth::guard('api')->setUser($user);

            return $next($request);
        }

        throw new AuthenticationException();
    }
}
