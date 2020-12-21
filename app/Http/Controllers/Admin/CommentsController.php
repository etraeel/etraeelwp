<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::where('approved' , 0)-> paginate(15);
//        $comments = Comment::where('approved' , 0)->get();
//         return $comments[1]->commentable;
        return view('admin.comments.all',compact('comments'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( Comment $comment)
    {
            $comment->forceFill([
                'approved' => 1,
            ])->save();
        alert()->success('دیدگاه با موفقیت تایید شد ');
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
        $comment->delete();
        alert()->success('دیدگاه با موفقیت حذف شد ');
        return back();
    }
}
