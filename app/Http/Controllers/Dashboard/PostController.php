<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ResponseMessages;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::whereUserId(auth()->id())
                ->select('id', 'title', 'created_at')->paginate(12);
        return view('home',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PostRequest $request)
    {
        $image=uploadSingleFile("posts",request()->file('image'));
        $post = Post::create([
            'title'=>$request->title,
            'author'=>$request->author,
            'content'=>$request->content,
            'image'=>$image,
            'user_id'=>auth()->id()
        ]);
        return response()->json([
            'status'=>true,
            'message'=>ResponseMessages::CREATED_SUCCESSFULLY,
            'post'=>$post //  image accessor in model return =>  path + image name
        ],201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $this->authorize('view', $post);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {

        // check post to user
        $this->authorize('update', $post);
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PostRequest $request, Post $post)
    {
        // check post to user
        $this->authorize('update', $post);

        $image = null;
        // if upload image
        if($request->file('image')){
            // delete old image
            deleteFile('posts', $post->getAttributes()['image']);
            // upload new image
            $image=uploadSingleFile("posts",request()->file('image'));
        }
        $data = [
            'title' => $request->title,
            'author' => $request->author,
            'content' => $request->content,
        ];
        if($image){
            $data["image"] = $image;
        }
        $post->update($data);
        return response()->json([
            'status'=>true,
            'message'=>ResponseMessages::UPDATED_SUCCESSFULLY,
            'post'=>$post, //  image accessor in model return =>  path + image name
            "update"=>true
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // check post to user
        $this->authorize('delete', $post);
        $post->delete();
        toastr()->success("Moved to trash successfull", "Success");
        return redirect()->route('posts.index');
    }

     /**
      * posts trashed
      * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
      */

    public function trashed(){
        $posts = Post::whereUserId(auth()->id())
                ->onlyTrashed()
                ->select('id', 'title', 'created_at')
                ->paginate(12);
        return view('posts.trashed',compact('posts'));
    }

    /**
     * restore post
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id){
        $post = Post::whereUserId(auth()->id())->onlyTrashed()->findOrfail($id);
        $this->authorize('restore', $post);
        $post->restore();
        toastr()->success("Restore completed successfully", "Success");
        return back();

    }

    /**
     * force Delete
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forceDelete($id){
        $post = Post::whereUserId(auth()->id())->onlyTrashed()->findOrfail($id);
        $this->authorize('restore', $post);
        deleteFile('posts', $post->getAttributes()['image']);
        $post->forceDelete();
        toastr()->success("Deleted successfully", "Success");
        return back();

    }
}
