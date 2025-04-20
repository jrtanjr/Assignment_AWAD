<?php 
 
namespace App\Http\Controllers\Auth; 
 
use App\Http\Controllers\Controller; 
use Illuminate\Foundation\Auth\AuthenticatesUsers; 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth; 
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
    protected $redirectTo = '/home'; 
 
    /** 
     * Create a new controller instance. 
     * 
     * @return void 
     */ 
    public function __construct() 
    { 
        $this->middleware('guest')->except('logout'); 
        $this->middleware('guest:admin')->except('logout'); 
        $this->middleware('guest:author')->except('logout'); 
    }
    public function showAdminLoginForm() 
    { 
        return view('auth.login', ['url' => 'admin']);
    } 
 
    public function adminLogin(Request $request) 
    { 
        $this->validate($request, [ 
            'email'   => 'required|email', 
            'password' => 'required|min:6' 
        ]); 
 
        if (Auth::guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ], $request->has('remember'))) {
            // 
            // Set session value
            // session(['admin_user_id' => Auth::guard('admin')->id()]);
        
            // Optional: Set a cookie (e.g. admin name, 60 min)
            // cookie()->queue(cookie('admin_name', Auth::guard('admin')->user()->name, 60));
        
            return redirect()->intended('/admin');
        } 
        return back()->withInput($request->only('email', 'remember')); 
    } 
 
     public function showAuthorLoginForm() 
    { 
        return view('auth.login', ['url' => 'author']); 
    } 
 
    public function logInAuthor()
    {
        return view('auth.login', ['url' => 'author']);
    }

    public function authorLogin(Request $request) 
    { 
        $this->validate($request, [ 
            'email'   => 'required|email', 
            'password' => 'required|min:6' 
        ]); 
 
        if (Auth::guard('author')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ], $request->has('remember'))) {
        
            session(['author_user_id' => Auth::guard('author')->id()]);
            cookie()->queue(cookie('author_name', Auth::guard('author')->user()->name, 60));
        
            return redirect()->intended('/author');
        }
        return back()->withInput($request->only('email', 'remember')); 
    } 
    public function logout(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
            session()->forget('admin_user_id');
            cookie()->queue(cookie()->forget('admin_name'));
        } elseif (Auth::guard('author')->check()) {
            Auth::guard('author')->logout();
            session()->forget('author_user_id');
            cookie()->queue(cookie()->forget('author_name'));
        }
    
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect()->route('logout');
    }
} 