<?php

namespace App\Http\Controllers\Admin;

use App\Model\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\blog\AddBlogRequest;
use App\Http\Requests\blog\UpdateBlogRequest;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::latest()->paginate(3);

        return view('admin.blog.all', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog.add');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddBlogRequest $request)
    {
        $file = $request->image;
        Blog::create([
            'title' => $request->title,
            'image' => $file->getClientOriginalName(),
            'description' => $request->description,
            'content' => $request->content

        ]);

        if(!empty($file)){
            $file->move('upload/image', $file->getClientOriginalName());
        }

        return redirect()->route('blog.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($blog)
    {
        $blog = BLog::find($blog);

        return view('admin.blog.update', compact('blog'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogRequest $request, $id)
    {
        $file = $request->image;
        $data = $request->all();
        $blog = Blog::find($id);
        $thumbnailOld = $blog->image;

        if(!empty($file))
        {
            $data['image'] = $file->getClientOriginalName();
        }else{
            $data['image'] = $blog->image;
        }

        $blog->update([
            $blog->title = $data['title'],
            $blog->image = $data['image'],
            $blog->description = $data['description'],
            $blog->content = $data['content']
        ]);

        if(!empty($file)){
            $file->move('upload/image', $file->getClientOriginalName());
        }
        if(File::exists(public_path($thumbnailOld))){
            File::delete(public_path($thumbnailOld));
        }

        return redirect()->route('blog.index');


        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($blog)
    {
        $blog = Blog::find($blog);

        $blog->delete();

        return redirect()->route('blog.index');
    }
}
