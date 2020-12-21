@extends('master/master')

@section('content')

    <div class="single_article">
        <div class="article_title">
            <h1>{{$article->title}}</h1>
            <div class="">
                <span id="like" class="like">{{count($article->likes()->get())}}</span>
                @if($article->status_like == 'like')
                    {{--                <i class="like_heart like_heart_liked fad fa-heart" ></i>--}}
                    <i class="like_heart like_heart_liked fas fa-heart"></i>
                @elseif($article->status_like == 'dislike')
                    <i class="like_heart fal fa-heart"></i>
                @endif

                <span class="counter" style="margin-right: 15px">{{$article->counter}}</span>
                <i class="fad fa-eye"></i>
                <input name="id" type="hidden" value="{{$article->id}}">
            </div>
        </div>
        <div class="article_details">
            <div class="writer">
                <span>ترجمه و تالیف : </span>
                <span>{{$article->writer}}</span>
            </div>

            <div class="date">
                <span>تاریخ انتشار : </span>
                <span>{{jdate($article->created_at)->format('%A, %d %B %y')}}</span>
            </div>

            <div class="read_time">
                <span>خواندن در  : </span>
                <span>{{$article->reading_time}}</span>
                <span>دقیقه</span>
            </div>

        </div>
        <div class="article_text">
            <p>{!! $article->text !!}</p>
        </div>


    </div>


@endsection
@section('script')
    <script>
        let article_id = document.querySelector('input[name="id"]').value;

        // document.querySelector('#btn_like').addEventListener('click', function (event) {
        //     event.preventDefault();
        //
        //     axios.patch('' + article_id , article_id )
        //     .then(response => { document.querySelector('span[id="like"]').innerHTML = response.data})
        //     // .then(response => console.log(response.data))
        //     .catch(error =>console.log(error))
        // })


        $('.like_heart').click(function (event) {

            event.preventDefault();

            axios.patch('' + article_id , article_id )
                .then(response => {
                    document.querySelector('span[id="like"]').innerHTML = response.data['like_number'];
                    if(response.data['status'] === 'like'){
                        $( ".like_heart" ).removeClass( "fal" ).addClass("like_heart_liked fad");
                    }
                    else if(response.data['status'] === 'dislike'){
                        $( ".like_heart" ).removeClass( "like_heart_liked fad" ).addClass("fal");
                    }
                })
                // .then(response => console.log(response.data))
                .catch(error =>console.log(error))
        })



    </script>

@endsection
