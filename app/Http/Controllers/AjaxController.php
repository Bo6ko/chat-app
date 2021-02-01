<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Messages;

class AjaxController extends Controller
{
/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index(Request $request)
    {   

    }
    public function createMessage(Request $request)
    {        
        $data = $request->all();
        $message_text = $data['message_text'];
        $user = User::getByEmail( $request->session()->get('user_email') );

        DB::update('INSERT INTO messages (message_text, user_id, message_create_date) VALUES(?,?,?) ', 
            [$message_text, $user[0]->user_id, date('Y-m-d H:i:s')]
        );

        $message_date = date('H:m A', strtotime(date('Y-m-d H:i:s')));

        return response()->json(
            ['success'      => true, 
            'message_text'  => $message_text,
            'message_date'  => $message_date,
            'user'          => $user
            ]);

    }

    public function getAllMessage(Request $request)
    {        
        // $data = $request->all();
        // $message_text = $data['message_text'];
        $user = User::getByEmail( $request->session()->get('user_email') );
        $messageObj = new Messages();
        $messages = $messageObj->getAll();
        $data["user_email"] = $request->session()->get('user_email');

        return response()->json(
            ['success'      => true, 
            'messages'      => $messages,
            'user'          => $user
            ]);

    }

}