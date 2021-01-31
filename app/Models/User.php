<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAllUsers() {
        $users = DB::table('users')->get();
        return $users;
    }

    public static function getByEmail( $user_email ) {
        $user = DB::table('users')->where(['user_email' => $user_email])->get();
        return $user;
    }

    public function isExistsByEmail( $user_email ) {
        $user = DB::table('users')->where(['user_email' => $user_email])->get();
        if ( count($user) > 0 ) {
            return true;
        }
        return false;
    }

    public function isSuccessfullyLogin( $user_email, $user_password ) {
        $user = DB::table('users')->where(['user_email' => $user_email, 'user_password' => $user_password])->get();
        if ( count($user) > 0 ) {
            return true;
        }
        return false;
    }
}
