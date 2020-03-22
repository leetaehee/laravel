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

        dd($user);
    }
}
