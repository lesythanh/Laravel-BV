<?php

namespace App\Http\Controllers\Frontend;

use App\Model\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // public function index()
    // {
    //     $comments = Comment::all();
    //     return view('frontend.blog.singer-blog', compact('comments'));
    // }

    public function store(Request $request)
    {
        $levelParent = $request->level;
        if ($levelParent == null) {
            $userId = Auth::id();
            $comment = $request->comment;
            $blog_id = $request->blog_id;
            $user_id = auth()->user()->id;
            $user_name = auth()->user()->name;
            $user_avatar = auth()->user()->avatar;
            $level = 0;
            
            Comment::create([
                'comment' => $comment,
                'blog_id' => $blog_id,
                'user_id' => $user_id,
                'user_name' => $user_name,
                'user_avatar' => $user_avatar,
                'level' => 0
            ]);

            return back();
        }else{
            $userId = Auth::id();
            $comment = $request->comment;
            $blog_id = $request->blog_id;
            $user_id = auth()->user()->id;
            $user_name = auth()->user()->name;
            $user_avatar = auth()->user()->avatar;
            $level = 0;
            
            Comment::create([
                'comment' => $comment,
                'blog_id' => $blog_id,
                'user_id' => $user_id,
                'user_name' => $user_name,
                'user_avatar' => $user_avatar,
                'level' => $levelParent
            ]);

            return back();
        }
        
    }
}
