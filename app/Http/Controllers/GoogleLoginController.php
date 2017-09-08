<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use Auth;
use App\User;

class GoogleLoginController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        $googleUser = Socialite::driver('google')->user();
       // dd($user);
       $user = User::where('google_id',$googleUser->getId())->first();
       if(!$user) //null
           $user = new User();

       $user->google_id = $googleUser->getId();
       $user->name = $googleUser->getName();
       $user->email = $googleUser->getEmail();
       $user->social_image = $googleUser->getAvatar();
       $user->password = '';
       $user->save();

       Auth::login($user);//inicio de sesion
       return redirect('/home');
    }
}
