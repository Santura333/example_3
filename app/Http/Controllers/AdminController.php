<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Pipeline;

use App\Actions\Fortify\AttemptToAuthenticate;
use App\Actions\Fortify\RedirectIfTwoFactorAuthenticatable;
use App\Http\Responses\LoginResponse;

use Laravel\Fortify\Contracts\LoginViewResponse;
use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Features;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Requests\LoginRequest;
use Laravel\Fortify\Actions\EnsureLoginIsNotThrottled;
use Laravel\Fortify\Actions\PrepareAuthenticatedSession;




class AdminController extends Controller
{
    //
    /**
     * The guard implementation.
     * Triển khai của cơ chế bảo vệ"
     * lấy cơ chế này từ .. sau đây
     * @var \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected $guard;
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\StatefulGuard  $guard
     * @return void
     */

    //nhận vào một đối tượng StatefulGuard thông qua tham số $guard và gán giá trị của tham số này cho biến $guard trong lớp.
    //use to chuyển đối tượng StatefulGuard từ bên ngoài vào lớp hiện tại, để lớp có thể sử dụng và tương tác với đối tượng StatefulGuard trong các phương thức khác của nó.
    //  public function __construct(StatefulGuard $guard)
    // {

    //     // Dòng mã $this->guard = $guard;được sử dụng để gán giá trị của biến $guard cho thuộc tính $guard của đối tượng hiện tại.
    //     $this->guard = $guard;

    // }
    // public function __construct()
    // {
    //     $this->middleware('guest:admin')->except('logout');
    // }

    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;

    }

    public function index(){
        
    }


    public function loginForm()
    {
        return view('auth.admin_login', ['guard' => 'admin']);
    }

    /**
     * Attempt to authenticate a new session.
     *
     * @param  \Laravel\Fortify\Http\Requests\LoginRequest  $request
     * @return mixed
     */
    public function store(LoginRequest $request)
    {
        return $this->loginPipeline($request)->then(function ($request) {
            return app(LoginResponse::class);
        });
    }

    /**
     * Get the authentication pipeline instance.
     *
     * @param  \Laravel\Fortify\Http\Requests\LoginRequest  $request
     * @return \Illuminate\Pipeline\Pipeline
     */
    protected function loginPipeline(LoginRequest $request)
    {

        if (Fortify::$authenticateThroughCallback) {
            // Pipeline là một công cụ mạnh mẽ trong Laravel, cho phép bạn xây dựng một chuỗi các bước xử lý tuần tự.
            // tao 1 object tu class pipeline
            return (new Pipeline(app()))->send($request)->through(
                array_filter(
                    call_user_func(Fortify::$authenticateThroughCallback, $request)
                )
            );
        }

        if (is_array(config('fortify.pipelines.login'))) {
            return (new Pipeline(app()))->send($request)->through(
                array_filter(
                    config('fortify.pipelines.login')
                )
            );
        }

        return (new Pipeline(app()))->send($request)->through(array_filter([
            config('fortify.limiters.login') ? null : EnsureLoginIsNotThrottled::class,
            Features::enabled(Features::twoFactorAuthentication()) ? RedirectIfTwoFactorAuthenticatable::class : null,
            AttemptToAuthenticate::class,
            PrepareAuthenticatedSession::class,
        ]));
    }

    /**
     * Destroy an authenticated session.
     * use to hủy 1 phiên xác thực(or đăng nhập) để logout
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Fortify\Contracts\LogoutResponse
     */
    public function destroy(Request $request): LogoutResponse
    {
        $this->guard->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return app(LogoutResponse::class);
    }




    public function showLoginForm()
    {
        return view('auth.admin_login', ['guard' => 'admin']);
    }

    // public function login(Request $request)
    // {
    //     try {
    //         $request->validate([
    //             'email' => 'email|required',
    //             'password' => 'required'
    //         ]);

    //         $credentials = request(['email', 'password']);

    //         if (!Auth::attempt($credentials)) {
    //             return response()->json([
    //                 'status_code' => 500,
    //                 'message' => 'Unauthorized'
    //             ]);
    //         }

    //         $admin = Admin::where('email', $request->email)->first();

    //         // if (!Hash::check($request->password, $admin->password, [])) {
    //         //     throw new \Exception('Error in Login');
    //         // }

    //         if ($request->password != $admin->password) {
    //             throw new \Exception('Error in Login');
    //         }

    //         $tokenResult = $admin->createToken('authToken')->plainTextToken;

    //         return response()->json([
    //             'status_code' => 200,
    //             'access_token' => $tokenResult,
    //             'token_type' => 'Bearer',
    //         ]);
    //     } catch (\Exception $error) {
    //         return response()->json([
    //             'status_code' => 500,
    //             'message' => 'Error in Login',
    //             'error' => $error,
    //         ]);
    //     }
    // }

    public function getLogin()
    {
        return view('admin.auth.login');
    }







}