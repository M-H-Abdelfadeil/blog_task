<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ResponseMessages;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request , Post $post)
    {
        Comment::create([
            'comment'=>$request->comment,
            'post_id'=> $post->id,
            'user_id'=>auth()->id()
        ]);

        toastr()->success(ResponseMessages::CREATED_SUCCESSFULLY , "Success");
        return back();
    }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);
        $comment->update(['comment' => $request->comment]);
        toastr()->success(ResponseMessages::UPDATED_SUCCESSFULLY, "Success");
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();
        return back();
    }
}
