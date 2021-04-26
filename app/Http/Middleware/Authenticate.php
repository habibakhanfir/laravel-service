<?php

namespace App\Http\Middleware;

use Firebase\JWT\JWT;

use Illuminate\Http\Request;

class Authenticate
{
    private $jwt;

    public function __construct(JWT $jwt)
    {
        $this->jwt = $jwt;
    }


    /**
     * @param Request $request
     * @param \Closure $next
     * @return \Illuminate\Http\JsonResponse|mixed|string
     */
    public function handle(Request $request, \Closure $next)
    {
        $token = $request->bearerToken();

        if (empty($token)) {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized'
            ]);
        }


        $token = $this->jwt::decode($token, env('JWT_SECRET'), ['HS256']);

        $request->merge(['user_id' => $token->user_id]);

        return $next($request);

    }
}
