<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ImageSizeRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Storage;
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

    public function logout(Request $request)
    {

        Auth::logout();
        return ;
    }

    public function updateProfile (ImageSizeRequest $request){
        $user=User::where('id', $request->id)->first();
        if($user->avatar_image!=='avatar/no-image-icon-23479.png'){
            Storage::disk('s3')->delete($user->avatar_image);
        }
        $file= $request->file('file');
        $file_name = Storage::disk('s3')->putFile('avatar', $file, 'public');
        $user->update([
            'avatar_image'=>$file_name,
        ]);

        return json_encode(['img'=>$file_name]);
    }

    public function updateTextProfile (ProfileRequest $request){
        User::where('id', $request->id)->update([
            'name'=>$request->name,
            'profile'=>$request->profile,
        ]);
    }
}
