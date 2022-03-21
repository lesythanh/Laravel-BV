@extends('frontend.layouts.app')
@section('content')
<div class="blog-post-area">
    <h2 class="title text-center">Latest From our Blog</h2>
    <div class="single-blog-post">
        <h3>{{$blogs->title}}</h3>
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
            <img src="{{asset('upload/image/'.$blogs->image)}}" alt="">
        </a>
        <p>{!! $blogs->content !!}</p>
        <div class="pager-area">
            <ul class="pager pull-right">
                @if ($pre)
                <li><a href="{{$pre}}">Pre</a></li>
                @endif

                @if ($next)
                <li><a href="{{$next}}">Next</a></li>
                @endif
            </ul>
        </div>
    </div>
</div><!--/blog-post-area-->

<div class="rating-area">
    <script>
        if(screen.width <= 736){
            document.getElementById("viewport").setAttribute("content", "width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no");
        }
    </script>
    <link type="text/css" rel="stylesheet" href="{{ asset('rating/css/rate.css')}}">
    <script src="{{ asset('rating/js/jquery-1.9.1.min.js')}}"></script>

  </head>
  <body>
        <!-- begin header -->   
            <div class="rate">
                <div class="rating">
                    @for ($i = 1; $i <= 5 ; $i++)
                    <div class="star_{{$i}} ratings_stars {{$i <= $rating ? "ratings_over": "" }} "><input data-blog_id="{{$blogs->id}}" value="{{$i}}" type="hidden"></div>
                    @endfor
                    
                    <span class="rate-np">{{$rating}}</span>
                </div> 
            </div>    
            
            <script>
                $(document).ready(function(){
                    //vote
                    $('.ratings_stars').hover(
                        // Handles the mouseover
                        function() {
                            $(this).prevAll().andSelf().addClass('ratings_hover');
                            // $(this).nextAll().removeClass('ratings_vote'); 
                        },
                        function() {
                            $(this).prevAll().andSelf().removeClass('ratings_hover');
                            // set_votes($(this).parent());
                        }
                    );
        
                    $('.ratings_stars').click(function(){
                        var values =  $(this).find("input").val();
                        var blog_id = $(this).find("input").data('blog_id');
                        var login = "{{ Auth::check() }}";
                        var user_id = "{{ Auth::user() ? Auth::user()->id : null}}";
                        var _token = '{{csrf_token()}}'
                        // alert(values);
                    if(login){
                        if ($(this).hasClass('ratings_over')) {
                            $('.ratings_stars').removeClass('ratings_over');
                            $(this).prevAll().andSelf().addClass('ratings_over');
                        } else {
                            $(this).prevAll().andSelf().addClass('ratings_over');
                        }

                        $.ajax({
                            url:"{{url('blog/rating')}}",
                            method:"POST",
                            data:{values:values, blog_id:blog_id, user_id:user_id, _token:_token},
                            success:function(data)
                            {
                                if(data == 'done')
                                {
                                    alert("bạn đã đánh giá thành công")
                                }else{
                                    alert("lỗi đánh giá")
                                }
                            }
                        })
                    }else{
                        $('.ratings_stars').removeClass('ratings_over');
                        $("#notification").text('vui lòng đăng nhập')
                    }
                    });
                });

            </script>
 </body>
</div><!--/rating-area-->

<div class="socials-share">
    <a href=""><img src="{{ asset('frontend/images/blog/socials.png')}}" alt=""></a>
</div><!--/socials-share-->

<div class="media commnets">
</div><!--Comments-->
<div class="response-area">
    <h2>3 RESPONSES</h2>
    <ul>
    @foreach ($blogComments['comment'] as $blogComment)
    @if ($blogComment['level'] == 0)
        <li class="media">
            <a class="pull-left" href="#">
                <img class="media-object" src="{{asset('upload/image/'.$blogComment['user_avatar'])}}" style="width:100px">
            </a>
            <div class="media-body">
                <ul class="sinlge-post-meta">
                    <li><i class="fa fa-user"></i>{{$blogComment['user_name']}}</li>
                    <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                    <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                </ul>
                <p>{{$blogComment['comment']}}</p>
                <a class="btn btn-primary" id="replay" >Replay</a>
                <input type="hidden" name="blog_id" value="{{$blogComment['id']}}">
                <script>
                    $(document).ready(function(){
                      $("a#replay").click(function(){
                        $(".comment").focus();
                        let id = $(this).closest("div.media-body").find("input").val();
                        $(".id_comment").val(id);
                      });
                    });
                </script>
            </div>
        </li>
    @endif
        
        
        @foreach ($childs['comment'] as $child)
        @if ($child['level'] == $blogComment['id'])
        <li class="media second-media">
            <a class="pull-left" href="#">
                <img class="media-object" src="{{asset('upload/image/'.$child['user_avatar'])}}" style="width:100px">
            </a>
            <div class="media-body">
                <ul class="sinlge-post-meta">
                    <li><i class="fa fa-user"></i>{{$child['user_name']}}</li>
                    <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                    <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                </ul>
                <p>{{$child['comment']}}</p>
                <a class="btn btn-primary" href=""></i>Replay</a>
            </div>
        </li>	     
        @endif
        @endforeach
    @endforeach
    </ul>
</div><!--/Response-area-->
<div class="replay-box">
    <form action="{{route('blogStore')}}" method="post">    
        @csrf
        <div class="col-sm-8">
            <div class="text-area">
                <div class="blank-arrow">
                    <label>Comment</label>
                </div>
                <input type="hidden" name="blog_id" value="{{$blogs->id}}">
                <input class="id_comment" type="hidden" name="level" value="">
                <textarea name="comment" rows="11" class="comment"></textarea>
                <button type="submit" class="btn btn-primary">Post Comment</button>
            </div>
        </div>
    </form>
    </div>
</div><!--/Repaly Box-->
@endsection