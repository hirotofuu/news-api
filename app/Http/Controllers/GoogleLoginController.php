<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class GoogleLoginController extends Controller
{
    public function getGoogleAuth()
    {
        return response()->json([
            'redirect_url' => Socialite::driver('google')->redirect()->getTargetUrl()
        ]);
    }

    public function authGoogleCallback(Request $request)
    {
        try {
            $user=Socialite::driver('google')->stateless()->user();
            $finduser = User::where("google_id", $user->id)->first();

            if ($finduser) {
                Auth::login($finduser);
                $request->session()->regenerate();
                return redirect('http://localhost:3000');
            } else {
                $newUser = User::create([
                    "name" => $user->name,
                    "email" => $user->email,
                    "google_id" => $user->id,
                ]);


                Auth::login($newUser);
                $request->session()->regenerate();
                return redirect('http://localhost:3000');


            }
        } catch (Exception $e) {
            \Log::error($e);
            throw $e->getMessage();
        }
    }
}
