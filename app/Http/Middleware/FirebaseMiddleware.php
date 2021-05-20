<?php

namespace App\Http\Middleware;

use Closure;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;

class FirebaseMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $auth = Firebase::auth();

        $id_token = $request->header('Authorization');

        $user = $auth->verifyIdToken($id_token);

        if (!$user) {
            new UnauthorizedException();
        }

        $request->user = $user;

        return $next($request);
    }
}
