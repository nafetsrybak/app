<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use Sluggable;

	public function sluggable(){
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    //
    protected $fillable = [
    	'category_id',
    	'photo_id',
    	'title',
    	'body'
    ];

    public function user(){
	    return $this->belongsTo('App\User');
    }

    public function photo(){
	    return $this->belongsTo('App\Photo');
    }

    public function category(){
    	return $this->belongsTo('App\Category');
    }

    public function comments(){
    	return $this->hasMany('App\Comment');
    }

    public function replies(){
		return $this->hasManyThrough('App\CommentReply', 'App\Comment');
    }

    public function setBodyAttribute($body){
        $this->attributes['body'] = str_replace(['script'], '', $body);
    }
}
