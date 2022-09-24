<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthMiddleware
{
    private array $publicRoutes = [
        'api/auth/login',
        'api/auth/register',
    ];

    public function handle(Request $request, \Closure $next)
    {
        if(!$this->isPublic($request) && !$this->isAuthenticated($request)){
            return response()->json(null, Response::HTTP_UNAUTHORIZED);
        }
        return $next($request);
    }

    private function isAuthenticated(Request $request)
    {
        return auth('sanctum')->check();
    }

    private function isPublic(Request $request): bool
    {
        return in_array($this->getUri($request), $this->publicRoutes, true);
    }

    private function getUri(Request $request): string
    {
        return $request->route()->uri;
    }
}
