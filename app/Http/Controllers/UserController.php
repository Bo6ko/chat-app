<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserController extends Controller
{
/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        return view('user.login');
    }

    public function all_users(Request $request)
    {
        if ( empty($request->session()->get('user_email')) ) {
            return view('user.login');
        }
        $user = new User();
        $users = $user->getAllUsers();

        return view('user.all_users', ['users' => $users]);
    }

    public function login(Request $request)
    {
        return view('user.login');
    }
    public function login_post(Request $request)
    {
        extract($request->post());
        $err = array();
        $user = new User();
        $isSuccessfullyLogin = $user->isSuccessfullyLogin( $user_email, $user_password );

        if ( !$isSuccessfullyLogin ) {
            $err['wrong_login'] = 'Your email or password are wrong!';
        }

        if ( empty($err) ) {
            $request->session()->put('user_email', $user_email);
            return view('index',
            [
                'data' => $request->post()
            ]);
        }
        return view('user.login',
        [
            'data' => $request->post(),
            'err'  => $err,
        ]);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user_email');
        return view('user.login');
    }

    public function register(Request $request)
    {
        return view('user.register');
    }
    public function register_post(Request $request)
    {
        extract($request->post());
        $err = array();
        $user = new User();
        $isExistUser = $user->isExistsByEmail( $user_email );

        if ( empty($user_name) || strlen($user_name) < 4 ) {
            $err['user_name'] = 'This field is required and must be more than 3 symbols!';
        }

        if ( $isExistUser ) {
            $err['user_email'] = 'This email already exists!';
        }
        if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
            $err['user_email'] = "Invalid email format";
        }
        if ( empty($user_email) || strlen($user_email) < 4 ) {
            $err['user_email'] = 'This field is required and must be more than 3 symbols!';
        }

        if ( empty($user_password) || strlen($user_password) < 4 ) {
            $err['user_password'] = 'This field is required and must be more than 3 symbols!';
        }

        if ($user_password != $user_repeat_password) {
            $err['password_not_equal'] = 'Fields: password and repeat password are not equal!';
        }   
        
        if ( empty($err) ) {
            DB::table('users')->insert([
                'user_name'  => $user_name,
                'user_email' => $user_email,
                'user_password' => $user_password
            ]);
            return view('user.login', 
                [
                    'data'=> $request->post(),
                    'success_register' => true
                ]
            );
        }        

        return view('user.register', 
            [
                'data'=> $request->post(),
                'err' => $err
            ]
        );
    }



}