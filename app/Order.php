<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    protected $dates = ['travel_date'];


    public function setFromNameAttribute($value)
    {
        $this->attributes['from_name'] = ucwords($value);
    }
    public function getFromNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function setToNameAttribute($value)
    {
        $this->attributes['to_name'] = ucwords($value);
    }
    public function getToNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function setSenderNameAttribute($value)
    {
        $this->attributes['sender_name'] = ucwords($value);
    }
    public function getSenderNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function setReaderNameAttribute($value)
    {
        $this->attributes['reader_name'] = ucwords($value);
    }
    public function getReaderNameAttribute($value)
    {
        return ucfirst($value);
    }
}
