<?php



// ก๊อปเอาไปใช้ไฟลไหนก็ได้ เเต่ต้องทำตามขั้นตอนทั้งหมด 


// namespace  ต้องตรงกับ path ถ้าจะเอาเข้าไปใช้ในเเต่ละอัน
// เข้าไปใน folder Admin
// namespace App\Http\Controllers\Admin\Auth;
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

// หน้า Login
    public function showLoginForm()
    {
        return view('admin.login');
    }  
    
    


    
    public function username()
    {
        return 'email';
    }



// โพสมาที่Route นี้
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }    

    protected function attemptLogin(Request $request)
    {
        $user = User::where($request->only($this->username()))
                                    ->where('password', md5($request->password))
                                    ->first();
        if( ! $user )
        {
            return false;
        }

        Auth::loginUsingId($user->id, $request->filled('remember'));
        return $user;

    }   



}
