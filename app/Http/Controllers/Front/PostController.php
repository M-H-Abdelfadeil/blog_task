<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
       $posts = Post::select('id', 'title', 'image' ,'created_at')->paginate(12);
       return view('welcome', compact('posts'));
    }

    public function show(Post $post){
        return view('blog.posts.show', compact('post'));
    }
}
