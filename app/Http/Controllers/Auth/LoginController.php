<?php
/**
 * Login controller
 * 
 * PHP version 7
 *
 * @category  Controllers
 * @package   App
 * @author    Phuc <phan.phuc.rcvn2012@gmail.com>
 * @copyright 2016 CriverCrane! Corporation. All Rights Reserved.
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      http://localhost/
 */
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\User;
use Carbon\Carbon;
/**
 * Handle user authentication
 * 
 * @category  Controllers
 * @package   App
 * @author    Phuc <phan.phuc.rcvn2012@gmail.com>
 * @copyright 2016 CriverCrane! Corporation. All Rights Reserved.
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      http://localhost/
 */
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
    protected $now;

    /**
     * Create a new controller instance.
     * 
     * @param App\User $user submitted by users
     * 
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->middleware('guest')->except('logout');
        $this->now = date_format(Carbon::now('Asia/Ho_Chi_Minh'), 'Y/m/d:H-i-s');
    }
    /**
     * Handle user login.
     * 
     * @param \Illuminate\Http\Request $request submitted by users
     * 
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        //Error messages
        $messages = [
            "email.required" => "Email không được để trống",
            "email.email" => "Email không đúng định dạng",
            "email.exists" => "Email không tồn tại",
            "password.required" => "Mật khẩu không được để trống",
            "password.min" => "Mật khẩu phải lớn hơn 6 ký tự"
        ];
        
        // validate the form data
        $validator = Validator::make($request->all(), ['email' => 'required|email|exists:users,email','password' => 'required|min:6'], $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            // attempt to log
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
                $request->session()->put('inforUser', $request->input());
                $this->user
                    ->where('email', $request->email)
                    ->update(['last_login_at' => $this->now, 'last_login_ip' => \Request::ip()]);
                return redirect()->intended(route('admin'));
            }
            // if unsuccessful -> redirect back
            return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors(['password' => 'Mật khẩu không chính xác.',]);
        }
    }
}