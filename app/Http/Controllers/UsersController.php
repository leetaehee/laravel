<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function respondCreated($message)
    {
        flash($message);

        return redirect('/');
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        //$socialUser = \App\User::whereEmail($request->input('email'))
        //    ->whereNull('password')->first();

        $socialUser = \App\User::socialUser($request->input('email'))->first();

        if ($socialUser) {
            return $this->updateSocialAccount($request, $socialUser);
        }

        return $this->createNativeAccount($request);
    }

    public function confirm($code)
    {
        $user = \App\User::whereConfirmCode($code)->first();

        if (!$user) {
            //flash('URL이 정확하지 않습니다.');
            //return redirect('/');
            return $this->respondCreated('URL이 정확하지 않습니다.');
        }

        $user->activated = 1;
        $user->confirm_code = null;
        $user->save();

        auth()->login($user);

        //flash(auth()->user()->name . '님, 환영합니다. 가입 확인되었습니다.');
        //return redirect('/');

        return $this->respondCreated(auth()->user()->name . '님, 환영합니다. 가입 확인되었습니다.');
    }

    public function updateSocialAccount(Request $request, \App\User $user)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'password' => 'required|confirmed|min:6'
        ]);

        $user->update([
            'name' => $request->input('name'),
            'password' => bcrypt($request->input('password')),
        ]);

        auth()->login($user);

        return $this->respondCreated($user->name . '님 환영합니다.');
    }

    public function createNativeAccount(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'min:6|same:password',
        ]);

        $confirmCode = Str::random(60);

        $user = \App\User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'confirm_code' => $confirmCode
        ]);

        // 메일발송
        event(new \App\Events\UserCreated($user));

        //flash('가입하시 메일 계정으로 가입 확인 메일을 보내드렸습니다. 가입 확인하시고 로그인 해 주세요.');
        //return redirect('/');

        return $this->respondCreated(
            '가입하시 메일 계정으로 가입 확인 메일을 보내드렸습니다. 가입 확인하시고 로그인 해 주세요.');
    }
}
