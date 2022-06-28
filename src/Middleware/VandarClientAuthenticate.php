<?php

namespace Vandar\Sso\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Middleware\AuthenticatesRequests;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Vandar\Sso\Model\Client;

class VandarClientAuthenticate implements AuthenticatesRequests
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
            ->get(config('sso.server_uri').'/api/v1/clients/information');


        if (!$response || !$response->ok()) {
            throw new AuthenticationException();
        }

        if ($response->json('data.revoked') === true) {
            return response()->json(['status' => 0, 'error' => 'حساب شما مسدود شده است'], Response::HTTP_BAD_REQUEST);
        }

        $client = new Client();
        $client->setData($response->json('data'));
        
        request()->merge(["client" => $client]);

        return $next($request);
    }
}
