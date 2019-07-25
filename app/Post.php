<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

// use Cviebrock\EloquentSluggable\Sluggable;
// use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Post extends Model implements SluggableInterface
{
	use SluggableTrait;

	// use Sluggable;
 //    use SluggableScopeHelpers;

	protected $sluggable = [
		'build_from' => 'title',
		'save_to' => 'slug',
		'on_update' => true
	];
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
}
