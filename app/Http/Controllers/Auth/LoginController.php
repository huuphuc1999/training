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
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use session;

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
     * @param App\Models\User $user submitted by users
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
            "email.required" => "Email kh??ng ???????c ????? tr???ng",
            "email.email" => "Email kh??ng ????ng ?????nh d???ng",
            "email.exists" => "Email kh??ng t???n t???i",
            "password.required" => "M???t kh???u kh??ng ???????c ????? tr???ng",
            "password.min" => "M???t kh???u ph???i l???n h??n 6 k?? t???",
        ];

        // validate the form data
        $validator = Validator::make($request->all(), ['email' => 'required|email|exists:users,email', 'password' => 'required|min:6'], $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            // attempt to log
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
                $request->session()->put('inforUser', $request->input());
                $this->user
                    ->where('email', $request->email)
                    ->update(['last_login_at' => $this->now, 'last_login_ip' => \Request::ip()]);
                return redirect()->intended(route('users.index'));
            }
            // if unsuccessful -> redirect back
            return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors(['password' => 'M???t kh???u kh??ng ch??nh x??c.']);
        }
    }
    /**
     * Handle user logout.
     *
     * @param \Illuminate\Http\Request $request submitted by users
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        session()->forget('inforUser');

        Auth::logout();

        return redirect()->route('login');
    }
}
