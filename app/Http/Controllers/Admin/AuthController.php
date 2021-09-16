<?php

namespace App\Http\Controllers\Admin;

use App\Traits\APIResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Laravel\Sanctum\NewAccessToken;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{

    use APIResponse;

    /**
     * Обработка попыток аутентификации.
     *
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        //        dd('tst',$credentials,  $request->all());

        if (Auth::attempt($credentials)) {
//            $request->session()->regenerate();

            /** @var \App\Models\User $user */
            $user = Auth::user();


//            $user->tokens()->delete();

            $token = $user->createToken($user->getName());


            return $this->sendResponse(['token' => $token->plainTextToken]);
        }


        return $this->sendError('Not authenticate');
    }

}
