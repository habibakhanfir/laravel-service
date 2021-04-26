<?php


namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Routing\Controller;

class TestController extends Controller
{
    public function test()
    {
        try {
            $user = User::create([
                'name' => 'habiba',
                'email' => 'habiba@gmail.com',
                'password'=> 'habiba',
            ]);
        } catch (\Throwable $exception){
            dd($exception);
        }


    }
}
