<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    // to make laravel understand which columns in your database you can fillable you should

    protected $fillable = [ 'title' , 'decs' , 'img'] ;

    // Book belongsToMany categories
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

}
