<?php

namespace Vandar\Sso\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Middleware\AuthenticatesRequests;
use Illuminate\Http\Response;
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
        throw_if(is_null($request->bearerToken()), AuthenticationException::class);

        $response = Http::withToken($request->bearerToken())
            ->acceptJson()
            ->get(config('sso.server_uri').'/api/v1/users/informations');

        if (!$response || !$response->ok()) {
            throw new AuthenticationException();
        }

        if ($response->json('data.is_active') != 1) {
            return response()->json(['status' => 0, 'error' => 'حساب کاربری مسدود شده است'], Response::HTTP_BAD_REQUEST);
        }

        $user = new User();
        $user->setData($response->json('data'));
        Auth::guard('api')->setUser($user);

        return $next($request);
    }
}
