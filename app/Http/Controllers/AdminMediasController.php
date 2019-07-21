<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\MediasRequest;

use App\Photo;

class AdminMediasController extends Controller
{
    //
    protected $fillable = [
        'file'
    ];

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index(){
    	$photos = Photo::all();

    	return view('admin.media.index', compact('photos'));
    }

    public function create(){
    	return view('admin.media.create');
    }

    public function store(MediasRequest $request){
    	$input = $request->all();

    	$file = $request->file('file');

    	$name = time() . $file->getClientOriginalName(); 

    	$file->move('images', $name);

    	Photo::create(['file'=>$name]);

    	return "Photo has been uploaded!";
    }

    public function destroy($id){
    	$photo = Photo::findOrFail($id);

    	unlink(public_path() . $photo->file);

    	$photo->delete();

    	session()->flash('massage_text', 'The photo has been deleted!');

    	return redirect('admin/media');
    }
}
