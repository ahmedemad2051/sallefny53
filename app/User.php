<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone','birthdate','gender','affiliation','photo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    public function categories()
    {
        return $this->hasMany('App\Category');
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password']=bcrypt($password);
    }

    public function setBirthdateAttribute($date)
    {
        $this->attributes['birthdate']=Carbon::parse($date)->format('Y/m/d');
    }

//    public function setPhotoAttribute($file)
//    {
//        $this->attributes['photo']=$file->getClientOriginalName();
//    }
}
