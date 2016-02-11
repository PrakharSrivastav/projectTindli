<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'fname', 'lname', 'active', 'img_path', 'contact_num', 'mobile_num', 'tnc', 'registration_token',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'registration_token',
    ];

    public function setFnameAttribute($value)
    {
        $this->attributes['fname'] = ucwords($value);
    }
    public function getFnameAttribute($value)
    {
        return ucfirst($value);
    }

    public function setLnameAttribute($value)
    {
        $this->attributes['lname'] = ucwords($value);
    }
    public function getLnameAttribute($value)
    {
        return ucfirst($value);
    }

    public function setEmailAttributes($value)
    {
        $this->attributes['email'] = strtolower($value);
    }
    public function getEmailAttribute($value)
    {
        return strtolower($value);
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function applications()
    {
        return $this->hasMany('App\Application');
    }
    public function messages()
    {
        return $this->hasMany('App\Message');
    }
}
