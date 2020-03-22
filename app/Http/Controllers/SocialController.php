<?php

namespace App\Http\Controllers;

use App\Events\PasswordRemindCreated;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function execute(Request $request, $provider)
    {
        if (! $request->has('code')) {
            return $this->redirectToProvider($provider);
        }

        return $this->handleProviderCallBack($provider);
    }

    protected function redirectToProvider($provider)
    {
        return \Socialite::driver($provider)->stateless()->redirect();
    }

    protected  function handleProviderCallback($provider)
    {
        $user = \Socialite::driver($provider)->stateless()->user();

        // 깃에서
        $user = (\App\User::whereEmail($user->getEmail())->first())
            ?: \App\User::create([
               'name' => $user->getName() ?: 'unknown',
               'email'=> $user->getEmail() ?: 'lastride25@naver.com',
               'activated' => 1,
            ]);

        auth()->login($user);

        flash(auth()->user()->name . '님, 환영합니다.');

        return redirect('/');
    }
}
