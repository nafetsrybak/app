<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\PostsRequest;

use App\Post;
use App\Category;
use App\Photo;

use Illuminate\Support\Facades\Auth;

class AdminPostsController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except('post');
        $this->middleware('admin')->except('post');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::lists('name', 'id')->all();
        //$categories = '';

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsRequest $request)
    {
        //
        $input = $request->all();

        $user = Auth::user();

        if($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalName();

            $file->move('images', $name);

            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id;
        }

        $user->posts()->create($input);

        session()->flash('massage_text', 'The post has been created!');

        return redirect('admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::findOrFail($id);

        $categories = Category::lists('name', 'id')->all();

        return view('admin.posts.edit', compact(['post', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostsRequest $request, $id)
    {
        //
        //$post = Post::findOrFail($id);
        $post = Auth::user()->posts()->whereId($id)->first();

        $input = $request->all();

        if($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalName();

            $file->move('images', $name);

            if($post->photo){
                unlink(public_path() . $post->photo->file);

                $post->photo->update(['file'=>$name]);
                $input['photo_id'] = $post->photo->id;
            }else{
                $photo = Photo::create(['file'=>$name]);
                $input['photo_id'] = $photo->id;
            }
        }
        $post->update($input);

        session()->flash('massage_text', 'The post has been updated!');

        return redirect('admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::findOrFail($id);

        if($post->photo){
            unlink(public_path() . $post->photo->file);

            $post->photo->delete();
        }

        $post->delete();

        session()->flash('massage_text', 'The post has been deleted!');

        return redirect('admin/posts');
    }

    public function post($id){
        //можна зразу з коментами
        // $post = Post::with('comments')->findOrFail($id);

        //$post = Post::findOrFail($id);

        //$comments = $post->comments()->whereIsActive(1)->get();

        $post = Post::with([
            'comments' => function ($q){
                $q->whereIsActive(1);
            },
            'comments.replies' => function ($q){
                $q->where('is_active', 1);
            }
        ])->findOrFail($id);

        // $post = Post::with([
        //     'comments' => function($q){
        //         $q->with([
        //             'replies' => function($q){
        //                 $q->whereIsActive(1);
        //             }
        //         ])
        //         ->whereIsActive(1);
        //     }
        // ])->findOrFail($id);

        //dd($post);

        //$comments = $post->comments;

        //dd($post);

        return view('post', compact('post'));
    }
}
