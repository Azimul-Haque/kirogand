<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    public function payments(){
        return $this->hasMany('App\Payment');
    }

    public function messages(){
        return $this->hasMany('App\Message');
    }
    
    public function blogs(){
        return $this->hasMany('App\Blog');
    }

    public function authorities()
    {
        return $this->hasMany(UserAuthority::class);
    }

    public function localOffice()
    {
        return $this->belongsTo(LocalOffice::class, 'local_office_id');
    }



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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
