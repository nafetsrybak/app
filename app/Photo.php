<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
	protected $uploads = '/images/';
	//protected $empty = '/images/noimage.jpg';

    protected $fillable = [
    	'file'
    ];

    public function getFileAttribute($value){
    	//if($value){
        	return  $this->uploads .$value;
        //}
        //return $empty;
    }
}
