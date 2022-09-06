<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Admin;
use Validator;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
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
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN_HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
     //   $this->middleware('guest')->except('logout');
    }
    public function showLoginForm()
    {
        return view('admin.adminLogin');
    }
    public function username()
    {
        return 'username';
    }
    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function adminLoginPost(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);
        if (Auth::guard('admin')->attempt(['username' => $request->input('username'), 'password' => $request->input('password')])) {
            return redirect()->route("admin.home");
        } else {
            return view('admin.adminLogin')->with('error', 'your username and password are wrong.');
        }
    }

    public function destroy()
    {

       Auth::guard('admin')->logout();
       return redirect('/admin/login');
    }
}


