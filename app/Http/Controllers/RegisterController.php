<?php

namespace App\Http\Controllers;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'secret_id'=>uniqid(rand(), true),
            'password' => Hash::make($request->password)
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)){
            $request->session()->regenerate();
            return new UserResource(Auth::user());
        }
    }
}
