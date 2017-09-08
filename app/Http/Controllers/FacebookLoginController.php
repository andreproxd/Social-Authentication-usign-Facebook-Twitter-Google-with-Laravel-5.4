<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use Auth;
use App\User;

class FacebookLoginController extends Controller
{
    
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallback()
    {
        $facebookUser = Socialite::driver('facebook')->user();
       // dd($user);
        $user = User::where('facebook_id',$facebookUser->getId())->first();
        if(!$user) //null
            $user = new User();

        $user->facebook_id = $facebookUser->getId();
        $user->name = $facebookUser->getName();
        $user->email = $facebookUser->getEmail();
        $user->social_image = $facebookUser->getAvatar();
        $user->password = '';
        $user->save();

        Auth::login($user);//inicio de sesion
        return redirect('/home');
    }

}
