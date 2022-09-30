<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment; // 追加

class CommentController extends Controller
{
    
    public function store(Request $request)
   {
       $request->validate([
            'content' => 'required|max:255',
        ]);
        dd('work');
       $comment = new Comment();
       $comment->content = $request->content;
       $comment->work_id = $request->work_id;
       $comment->user_id = \Auth::user()->id;
       $comment->save();

       return back();
   }

    public function destroy(Request $request)
    {
        $comment = Comment::find($request->comment_id);
        $comment->delete();
        return back();
    }
}
