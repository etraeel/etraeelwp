@extends('master/master')

@section('content')


<div class="articles_section">
    <div class="articles_header">
        <h1>مقالات</h1>
    </div>
    <div class="articles_body ">
        <ul class="article_list owl-carousel">
            @foreach($articles as $article)
                <li class="box">

                    <div class="image_box">
                        <img src="{{$article->image}}" alt="">
                    </div>
                    <div class="body_box">
                        <a href="{{route('article.show' ,  $id = $article->id)}}"><h2 class="box_title">{{$article->title}}</h2></a>
                        <p class="box_text">{!! $article->description !!}</p>
                        <div class="box_keys">
                            <span >{{$article->key_words}}</span>
                        </div>
                        <div class="box_footer">
                            <span class="like">{{count($article->likes()->get())}}</span>
                            <i class="likeheart fal fa-heart"></i>

                            <span class="counter" style="margin-right: 15px">{{$article->counter}}</span>
                            <i class="fad fa-eye"></i>

                        </div>
                    </div>

                </li>
            @endforeach


        </ul>


    </div>


</div>

@endsection
@section('script')
    <script src="js/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function(){
            $(".owl-carousel").owlCarousel({
                loop:true,
                margin:15,
                rtl : true,
                padding : 10,
                autoplay : true,
                autoplayTimeout:3000,
                autoplayHoverPause:true,
                responsiveClass:true,
                responsive:{
                    0:{
                        items:1,
                    },
                    600:{
                        items:1,

                    },
                    780:{
                        items:2,
                    },
                    950:{
                        items:3,
                    },
                    1180:{
                        items:4,
                    }
                }
            });


        });


    </script>


@endsection
