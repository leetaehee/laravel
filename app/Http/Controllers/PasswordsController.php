<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PasswordsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function getRemind()
    {
        return view('passwords.remind');
    }

    public function postRemind(Request $request)
    {
        $this->validate($request, ['email' => 'required|email|exists:users']);

        $email = $request->get('email');
        $token = Str::random(64);

        \DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => \Carbon\Carbon::now()->toDateString()
        ]);

        // 이메일 발송
        event(new \App\Events\PasswordRemindCreated($email, $token));

        flash('비밀번호를 바꾸는 방법을 담은 이메일을 발송했습니다. 메일박스를 확인해주세요.');

        return redirect('/');
    }

    public function getReset($token = null)
    {
        return view('passwords.reset', compact($token));
    }

    public function postReset(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users',
            'password' => 'required|confirmed',
            'token' => 'required'
        ]);

        $token = $request->get('token');

        if (! \DB::table('password_resets')->whereToken($token)->first()) {
            flush('URL이 정확하지 않습니다.');

            return back()->withInput();
        }

        \DB::table('password_resets')->whereToken($token)->delete();

        flash('비밀번호를 바꾸었습니다. 새로운 비밀번호로 로그인하세요.');

        return redirect('/');


    }
}
