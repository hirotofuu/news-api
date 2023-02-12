<?php

namespace App\Http\Controllers;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {

        if (Auth::attempt($request->all())){
            return new UserResource(Auth::user());

        }

        throw ValidationException::withMessages([
            'loginFailed' =>['IDまたはパスワードが間違っています。']
        ]);
    }
}
