<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * gat all posts
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(){
       $posts = Post::select('id', 'title', 'image' ,'created_at')
       ->orderBy('id', 'DESC')
       ->paginate(12);
       return view('welcome', compact('posts'));
    }

    /**
     * get single post and comments  
     * @param mixed $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id){
      $post = Post::with(['comments'=>function($q){
        $q->orderBy('id', 'DESC');
      }],'comments.user:id,name')->findOrfail($id);
        return view('blog.posts.show', compact('post'));
    }
}
