<?php

namespace App\Http\Controllers\Auth;

use App\DTOs\NotificationDetails;
use App\Http\Controllers\Controller;
use App\Notifications\SystemAlert;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated($request, $user)
    {
        // Your custom logic after successful authentication
        // For example, dispatch an event or perform additional actions

        $notificationDetails = new NotificationDetails(
            'Welcome Back, ' . $user->name . '!',
            'You have successfully logged in.',
            'Explore Dashboard',
            '/dashboard',
            'Thank you for using our service.'
        );
        $user->notify(new SystemAlert($notificationDetails));
    }
}
