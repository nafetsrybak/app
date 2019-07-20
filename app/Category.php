<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = [
    	'name'
    ];

    //get posts of Category model
    public function posts(){
    	return $this->hasMany('App\Post');
    } 
}
