<?php

namespace App\Http\Controllers\Frontend;

use App\Model\Blog;
use App\Model\Rating;
use App\Model\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->paginate(3);
        return view('frontend.blog.blog-list', compact('blogs'));
    }

    public function detail($id)
    {
        $blogs = Blog::find($id);

       

        $blogComments = Blog::with(['comment' => function ($q) {
            $q->orderBy('id', 'desc')->where('level', 0 );
          }])->find($id)->toArray();

        $childs = Blog::with(['comment' => function ($q) {
            $q->orderBy('id', 'desc')->where('level', '!=', 0 );
          }])->find($id)->toArray();
        //   dd($childs);

        $rating = Rating::where('blog_id', $blogs->id)->avg('rating');
        $rating = round($rating);

        $pre = Blog::where('id', '<', $blogs->id)->max('id');

        $next = Blog::where('id', '>', $blogs->id)->min('id');

        return view('frontend.blog.singer-blog', compact('blogs','pre', 'next', 'rating', 'childs','blogComments'));
    }

    public function rating(Request $request)
    {
        // $userId = Auth::id();
        $data = $request->all();
        $check = Rating::where('user_id', $data['user_id'])->first();

        if($check == null){
            $rating = new Rating();
            $rating->blog_id = $data['blog_id'];
            $rating->user_id = $data['user_id'];
            $rating->rating = $data['values'];
            $rating->save();
            echo 'done';
        }
    }
}
