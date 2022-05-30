<?php

namespace Vandar\Sso\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Middleware\AuthenticatesRequests;
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
            ->get(config('sso.server_uri').'/api/v1/users/info');

        if ($response && $response->status() === 200) {
            $request->setUserResolver(function () use ($response) {
                $user = new User($response->json());

                return $user;
            });

            return $next($request);
        }

        throw new AuthenticationException();
    }
}
