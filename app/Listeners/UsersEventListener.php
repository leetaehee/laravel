<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UsersEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function subscribe(\Illuminate\Events\Dispatcher $events)
    {
        $events->listen(
            \App\Events\UserCreated::class, __CLASS__ . '@onUserCreated'
        );

        $events->listen(
            \App\Events\PasswordRemindCreated::class, __CLASS__ . '@onPasswordRemindCreated'
        );

    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $event->user->last_login = \Carbon\Carbon::now();

        return $event->user->save();
    }

    public function onUserCreated(\App\Events\UserCreated $event)
    {
        $user = $event->user;

        \Mail::send('emails.auth.confirm', compact('user'),
            function ($message) use ($user) {
                $message->to($user->email);
                $message->subject(
                    sprintf('[%s] 회원 가입을 확인해 주세요.', config('app.name'))
                );
            });
    }

    public function onPasswordRemindCreated($event)
    {
        \Mail::send('emails.passwords.reset',
            ['token' => $event->token],
            function ($message) use ($event) {
                $message->to($event->email);
                $message->subject(
                    sprintf('[%s] 비밀번호를 초기화하세요. 부탁드려요', config('app.name'))
                );
            }
        );
    }
}
