<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Resources\UserResource;


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
                $finduser->update([
                    'api_token'=>Hash::make(Str::random(60)),
                    'password'=>uniqid( uniqid() , true ),
                ]);
                $password=$finduser->password;
                return redirect("http://localhost:3000/mypage/login/{$password}");
            } else {
                $newUser = User::create([
                    "name" => $user->name,
                    "email" => $user->email,
                    "google_id" => $user->id,
                    'api_token' => Hash::make(Str::random(60)),
                    'password'=>uniqid( Str::random(100) , true ),

                ]);


                $password=$newUser->password;
                return redirect("http://localhost:3000/mypage/login/{$password}");
            }
        } catch (Exception $e) {
            \Log::error($e);
            throw $e->getMessage();
        }
    }
}
