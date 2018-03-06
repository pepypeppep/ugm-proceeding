<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Check if user is superadmin or not
     * @return boolean
     */
    public function isSuperadmin()
    {
        return $this->is_superadmin;
    }

    /*
    RELATION SECTION
     */
    
    public function institution(){
        return $this->belongsTo('App\Institution');
    }

    public function proceeding(){
        return $this->belongsToMany('App\Proceeding');
    }

    public function book(){
        return $this->belongsToMany('App\Book');
    }
    
}
