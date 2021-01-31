<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Messages extends Authenticatable
{
    use HasFactory, Notifiable;

    public function getAll() {
        $messages = DB::table('messages as m')
        ->leftJoin('users as u', 'u.user_id', '=', 'm.user_id')
        ->orderBy('m.message_id', 'desc')
        ->get()->take(50);
        return $messages;
    }
}
