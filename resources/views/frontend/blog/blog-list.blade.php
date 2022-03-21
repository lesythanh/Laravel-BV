@extends('frontend.layouts.app')
@section('content')


<div class="blog-post-area">
    @foreach ($blogs as $blog)
    <h2 class="title text-center">Latest From our Blog</h2>
    <div class="single-blog-post">
        <h3>{{$blog->title}}</h3>
        <div class="post-meta">
            <ul>
                <li><i class="fa fa-user"></i> Mac Doe</li>
                <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
            </ul>
            <span>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half-o"></i>
            </span>
        </div>
        <a href="">
            <img src="{{asset('upload/image/'.$blog->image)}}" style="width:350px">
        </a>
        <p>{{$blog->description}}</p>
        <a  class="btn btn-primary" href="{{route('blogDetail', $blog->id)}}">Read More</a>
        @endforeach
    </div>
    <div class="pagination-area">
        {{ $blogs->links() }}
    </div>
</div>
@endsection