<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Socialite;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

//    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
//    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //        $this->middleware('guest')->except('logout');
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function redirect()
    {
        return Socialite::driver('google')
                        ->scopes(config('google.scopes'))
                        ->with([
                            'access_type'     => config('google.access_type'),
                            'approval_prompt' => config('google.approval_prompt'),
                        ])
                        ->redirect();
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function callback()
    {
        if (!request()->has('code')) {
            return redirect('/');
        }

        /**
         * @var \Laravel\Socialite\Two\User $user
         */
        $user = Socialite::driver('google')->user();

        /**
         * @var \App\User $loginUser
         */
        $loginUser = User::updateOrCreate(
            [
                'email' => $user->email,
            ],
            [
                'name'          => $user->name,
                'email'         => $user->email,
                'access_token'  => $user->token,
                'refresh_token' => $user->refreshToken,
                'expires_in'    => $user->expiresIn,
            ]);

        auth()->login($loginUser, false);

        return redirect('/home');
    }

    public function logout()
    {
        auth()->logout();

        return redirect('/');
    }
}
