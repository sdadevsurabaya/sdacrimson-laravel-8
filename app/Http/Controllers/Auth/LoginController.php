<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    //  * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
    //  * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }
    protected function attemptLogin(Request $request)
    {
        #fungsi check apakah inputan email terdapat prefix . sebelum @
        $explode = explode("@",$request->email);
        $explode[0]=str_replace(".","",$explode[0]);
        $email = implode("@", $explode);
        //return (auth()->attempt(['email' => $request->email, 'password' => $request->password]));
        return (auth()->attempt(['email' => $email, 'password' => $request->password]));
    }

    protected function authenticated(Request $request, $user)
    {


        // if ($user->isAdmin()) { // do your magic here
        //     return redirect()->route('dashboard');
        // }
        // dump($user);
        // dump($user->id);
        // dump($user->name);
        // dd("test");
        if ($user->hasRole('Admin')) {
            return redirect('/admin/dashboard');
        } else  if ($user->hasRole('Sales')) {
            return redirect('/admin/dashboard');
        } else  if ($user->hasRole('Verifikator')) {
            return redirect('/admin/dashboard');
        } else  if ($user->hasRole('Member')) {
            // return redirect('/member/board');
        }

    }
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function showLoginForm()
    {
        // return view('auth.login');
        $title = "Sign In";
        $pages = "signin";
        return view('front.signin', compact('title', 'pages'));
    }
}
