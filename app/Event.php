<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    
  public $timestamps = true;
    protected $fillable = ['title', 'desc', 'image', 'category_id', 'harga_limit',  'status', 'user_id'];

    public function Categori()
    {
    	return $this->belongsTo('App\Categori', 'category_id');
    }

    public function Transfer()
    {
    	return $this->hasMany('App\Transfer', 'event_id');
    }

    public function User()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }
}
