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
        'name',
        'email',
        'password',
        'fname',
        'lname',
        'active',
        'img_path',
        'contact_num',
        'mobile_num',
        'tnc',
        'registration_token',
        'dob',
        'login_type'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'registration_token',
    ];

    /**
     * this array makes sure that all the elements (users table columns are Carbon\Carbon date objects)
     * @var array
     */
    protected $dates = ['dob'];

    /**
     * set fname in Title Format in the database
     * @param string $value first name of user
     */
    public function setFnameAttribute($value)
    {
        $this->attributes['fname'] = ucwords($value);
    }

    /**
     * get fname in TitleFormat from database
     * @param  string $value first name of the user
     * @return string first name of the user in Title Format
     */
    public function getFnameAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * set lname in Title Format in the database
     * @param string $value last name of user
     */
    public function setLnameAttribute($value)
    {
        $this->attributes['lname'] = ucwords($value);
    }

    /**
     * get lname in TitleFormat from database
     * @param  string $value last name of the user
     * @return string last name of the user in Title Format
     */
    public function getLnameAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * always set the email address in the database in the lowercase to maintain consistancy
     * @param string email address
     */
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }

    /**
     * get email address from the database in the lowercase
     * @param  string $value email address of the user
     * @return string        email address of the user
     */
    public function getEmailAttribute($value)
    {
        return strtolower($value);
    }

    /**
     * One-2-Many relation between User and Order
     */
    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    /**
     * One-2-Many relation between User and Applications
     */
    public function applications()
    {
        return $this->hasMany('App\Application');
    }

    /**
     * One-2-Many relation between User and Messages
     */
    public function messages()
    {
        return $this->hasMany('App\Message');
    }
}
