<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\Post;
use App\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(5);
        $categories = Category::all();

        return view('front.home', compact('posts', 'categories'));
    }

    public function post($slug){
        //можна зразу з коментами
        // $post = Post::with('comments')->findOrFail($id);

        //$post = Post::findOrFail($id);

        //$comments = $post->comments()->whereIsActive(1)->get();

        // $post = Post::with([
        //     'comments' => function ($q){
        //         $q->whereIsActive(1);
        //     },
        //     'comments.replies' => function ($q){
        //         $q->where('is_active', 1);
        //     }
        // ])->findOrFail($id);

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

        $post = Post::with([
            'comments' => function ($q){
                $q->whereIsActive(1);
            },
            'comments.replies' => function ($q){
                $q->where('is_active', 1);
            }
        ])->whereSlug($slug)->firstOrFail();

        $categories = Category::all();

        //dd($post);

        return view('post', compact('post', 'categories'));
    }
}
