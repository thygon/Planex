<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname','lastname', 'email', 'password',
    ];

    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function cart(){
        return $this->hasOne('App\Cart');
    }

    public function profile(){
        return $this->hasOne('App\Profile');
    }

    public function account(){
        return $this->hasOne('App\Account');
    }

    public function orders(){
        return $this->hasMany('App\Order');
    }

    //isadmin
    public function isadmin(){
        return ($this->isadmin == 1)? true: false;
    }
}
