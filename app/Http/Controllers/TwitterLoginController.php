<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use Auth;
use App\User;

class TwitterLoginController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('twitter')->redirect();
    }

    public function handleProviderCallback()
    {
        $twitterUser = Socialite::driver('twitter')->user();
       // dd($user);
       $user = User::where('twitter_id',$twitterUser->getId())->first();
       if(!$user) //null
           $user = new User();

       $user->twitter_id = $twitterUser->getId();
       $user->name = $twitterUser->getName();
       $user->email = $twitterUser->getEmail();
       $user->social_image = $twitterUser->getAvatar();
       $user->password = '';
       $user->save();

       Auth::login($user);//inicio de sesion
       return redirect('/home');
    }

}
