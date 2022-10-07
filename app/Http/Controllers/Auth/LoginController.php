<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // echo('stop');
       //$this->middleware('guest:admin')->except('adminLogout');
        
        $this->middleware('guest')->except('logout');
    }
    
    public function showadminLoginForm() {
        return view('auth.adminLogin');
    }
    
    
     /* 認証の試行を処理
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   
    public function adminLogin(Request $request)
    {
        
        $credentials = $request->validate([ // 入力内容のチェック
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($credentials)) { // ログイン試行
            if ($request->user('admin')->admin_level > 0) { // 管理権限レベルが0でないか
                $request->session()->regenerate(); // セッション更新

                return redirect()->intended('/admin/dashboard'); // ダッシュボードへ
                //return redirect()->intended(RouteServiceProvider::ADMIN_HOME);
            } else {
                Auth::guard('admin')->logout(); // if文でログインしてしまっているので、ログアウトさせる

                $request->session()->regenerate(); // セッション更新

                return back()->withErrors([ // 権限レベルが0の場合
                    'error' => 'You do not have permission to log in.',
                ]);
           }
        }

        return back()->withErrors([ // ログインに失敗した場合
            'error' => 'The provided credentials do not match our records.',
        ]);
    }
    
    
    public function adminLogout(Request $request)
    {
        if(Auth::guard('admin')->user() != null){
            Auth::guard('admin')->logout();
    
            $request->session()->invalidate();
    
            $request->session()->regenerateToken();
    
            return redirect('adminlogin');
        }else {
            return\App::abort(404);
        }
        
        
        
    }
    
    public function admindashboard(Request $request)
    {
        // dd(Auth::guard('admin')->user());
        if(Auth::guard('admin')->user() == null){
            return\App::abort(404);
        }
        else {
            if (Auth::guard('admin')->user()->admin_level == 1) {
                    return view('auth.adminDashboard');
                } 
            else 
                {
                return\App::abort(404);
            }
        }
    }
    
    
    
}
