<?php

namespace App\Repositories;

use App\Models\Token;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
/* @var JWT */
    private $jwt;

    public function __construct(JWT $jwt)
    {
        $this->jwt = $jwt;
    }

    /* @param string $email
     * @param string $password
     * @return User
     * @throws \Exception
     */
    public function getUser(string $email, string $password)
    {
        $user = User::firstWhere('email', $email);

        if (!$user) {
            throw new \Exception('user not found');
        }

        if (!\Hash::check($password, $user->password)) {
            throw new \Exception('incorrect password');
        }

        return $user;
    }

    public function createUser(string $name, string $email, string $password)
    {
        return User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password)
        ]);
    }

    public function createToken(string $userId)
    {
        $key = env('JWT_SECRET');
        $payload = array(
            "iss" => env('APP_URL'),
            "aud" => env('APP_URL'),
            "iat" => time(),
            "user_id" => $userId
        );

        $token = Token::create([
            "user_id" => $userId,
            "token"=> $this->jwt::encode($payload, $key)
        ]);

        return $token;
    }

    public function updateToken(string $userId)
    {
        $key = env('JWT_SECRET');
        $payload = array(
            "iss" => env('APP_URL'),
            "aud" => env('APP_URL'),
            "iat" => time(),
            "user_id" => $userId
        );

        $token = Token::firstWhere('user_id',$userId);
        $token->token = $this->jwt::encode($payload, $key);

        $token->update();

        return $token;
    }
}
