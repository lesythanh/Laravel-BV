<?php

namespace App\Http\Controllers\Api;

use App\Model\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class BlogController extends Controller
{
    public $successStatus = 200;

    public function index()
    {
        $blogs = Blog::with('comment')->paginate(config('admin.paginate'));

        return response()->json([
            'blog' => $blogs
        ]);
    }

    public function show($id)
    {

        if (!empty($id)) {

            // $getBlogDetail = Blog::with('comment')->find($id)->orderBy('comment.id', 'desc');

            $getBlogDetail = Blog::with(['comment' => function ($q) {
                $q->orderBy('id', 'desc');
            }])->find($id);

            return response()->json([
                'status' => 200,
                'data' => $getBlogDetail
            ]);
        }
    }

    public function register(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $password = bcrypt($request->password);
        $phone = $request->phone;
        $address = $request->address;
        $file = $request->avatar;
        // $id_country = $request->id_country;
        $level = 0;


        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'phone' => $phone,
            'address' => $address,
            // 'id_country' => $id_country,
            'avatar' => $file->getClientOriginalName(),
            'level' => 0

        ]);

        if (!empty($file)) {
            $file->move('upload/image', $file->getClientOriginalName());
        }
        return response()->json([
            'status' => 200,
            'user' => $user
        ]);
    }
}
