<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Messages;

class HomeController extends Controller
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
        if ( empty($request->session()->get('user_email')) ) {
            return view('user.login');
        }
        $messageObj = new Messages();
        $messages = $messageObj->getAll();
        $data["user_email"] = $request->session()->get('user_email');
        return view('index', ['data' => $data, 'messages' => $messages]);
    }



}