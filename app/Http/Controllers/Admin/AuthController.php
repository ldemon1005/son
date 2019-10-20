<?php

namespace App\Http\Controllers\Admin;

use App\Models\BaseModel;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    protected $auth;
    protected $userRepository;
    protected $loginAfterSignUp;

    public function __construct(Auth $auth, UserRepository $userRepository)
    {
        $this->auth             = $auth;
        $this->userRepository   = $userRepository;
        $this->loginAfterSignUp = true;
    }

    public function loginView(){
        $layout = "LANDING";
        if (Auth::check()) {
            return redirect()->route('dashboard-v1');
        } else {
            return view('admin.auth.login', compact('layout'));
        }
    }

    public function registerView(){
        $layout = "LANDING";
        if (Auth::check()) {
            return redirect()->route('dashboard-v1');
        } else {
            return view('admin.auth.register', compact('layout'));
        }
    }

    public function resetPassView(){
        $layout = "LANDING";
        if (Auth::check()) {
            return redirect()->route('dashboard-v1');
        } else {
            return view('admin.auth.reset_password', compact('layout'));
        }
    }

    public function loginAction(Request $request)
    {
        $validator = Validator::make($request->input(), [
            'user_name' => 'required',
            'password'   => 'required|min:6',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $credentials = $request->only('user_name', 'password', 'is_reset_pass');

        /** @var User $user */
        $user = $this->userRepository->findByEmail($credentials['user_name']) ? $this->userRepository->findByEmail($credentials['user_name']) : $this->userRepository->findByUsername($credentials['user_name']);
        if (!$user) {
            return redirect()->back()->withErrors('Tài khoản này không tồn tài!')->withInput();
        }
        if (!Hash::check($credentials['password'], $user->password)) {
            return redirect()->back()->withErrors('Sai mật khẩu!')->withInput();
        }

        if ($user->status == BaseModel::USER_LOCKED) {
            return redirect()->back()->withErrors('Tài khoản của bạn đã bị khoá!')->withInput();
        }

        $params = [
            'user_name' => $user->user_name,
            'email'     => $user->email,
            'password'  => $credentials['password']
        ];

        if (Auth::attempt($params)) {
            $msg_success = isset($credentials['is_reset_pass']) && $credentials['is_reset_pass'] ? 'Đổi mật khẩu thành công!' : 'Đăng nhập thành công!';

            return redirect()->route('dashboard-v1')->with(BaseModel::ALERT_SUCCESS, $msg_success);
        } else {
            return redirect()->back()->withErrors('Sai mật khẩu!')->withInput();
        }
    }

    public function registerAction(Request $request)
    {
        $this->validate($request, [
            'user_name'  => 'required|min:3|max:50',
            'email'      => 'required|email',
            'password'   => 'required|confirmed|min:6',
            'phone'      => 'required|regex:/[0-9]{10,11}/',
        ]);

        $credentials = $request->only('user_name', 'email', 'password', 'phone');

        $params['user_name']  = $credentials['user_name'];
        $params['email']      = $credentials['email'];
        $params['password']   = $credentials['password'];
        $params['phone']      = $credentials['phone'];
        $params['status']     = BaseModel::USER_ACTIVE;
        $user = $this->userRepository->findByUsername($params['user_name']);
        if ($user) {
            return redirect()->back()->withErrors('Tài khoản này đã tồn tại. Vui lòng nhập tài khoản khác.')->withInput();
        }
        /** @var User $user */
        $user = $this->userRepository->findByEmail($params['email']);

        if ($user) {
            return redirect()->back()->withErrors('Email này đã được sử dụng. Vui lòng nhập email khác.')->withInput();
        }
        //Create new user
        try {
            $user = $this->userRepository->createUser($params);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }

        if (!$user) {
            return redirect()->back()->withErrors('Đăng ký không thành công!')->withInput();
        }

        //Login after sign up
        if ($this->loginAfterSignUp) {
            return $this->loginAction($request);
        }

        return redirect()->back()->with(BaseModel::ALERT_SUCCESS, 'Đăng ký thành công!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('admin_auth_login_view')->with(BaseModel::ALERT_SUCCESS, 'Đăng xuất thành công!');
    }

    public function resetPasswordAction(Request $request)
    {
        $validator = Validator::make($request->input(), [
            'current_password' => 'required|min:6',
            'new_password'     => 'required|confirmed|min:6|different:current_password',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $credentials = $request->only('current_password', 'new_password');

        /** @var User $current_user */
        $current_user           = Auth::user();
        $params['user_name']   = $current_user->user_name ? $current_user->user_name : $current_user->email;
        $params['password']     = $credentials['current_password'];
        $params['new_password'] = $credentials['new_password'];
        /** @var User $user */
        $user = $this->userRepository->findByEmail($params['user_name']) ? $this->userRepository->findByEmail($params['user_name']) : $this->userRepository->findByUsername($params['user_name']);
        if (!$user) {
            return redirect()->back()->withErrors('Tài khoản này không tồn tài!')->withInput();
        }

        if (!app('hash')->check($params['password'], $user->password)) {
            return redirect()->back()->withErrors('Mật khẩu hiện tại mật khẩu không chính xác!')->withInput();
        }

        if ($user->status == BaseModel::USER_LOCKED) {
            return redirect()->back()->withErrors('Tài khoản của bạn đã bị khoá!')->withInput();
        }

        //Update new password
        try {
            $updated_user = $this->userRepository->updateUser($user->id, ['password' => app('hash')->make($params['new_password'])]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Đổi mật khẩu không thành công! Vui lòng thử lại')->withInput();
        }

        if (!$updated_user) {
            return redirect()->back()->withErrors('Đổi mật khẩu không thành công! Vui lòng thử lại')->withInput();
        }

        //Login after reset password
        if ($this->loginAfterSignUp) {
            $login_request = new Request(['user_name' => $params['user_name'], 'password' => $params['new_password'], 'is_reset_pass' => true]);
            return $this->loginAction($login_request);
        }

        return redirect()->back()->with(BaseModel::ALERT_SUCCESS, 'Đổi mật khẩu thành công!');
    }
}
