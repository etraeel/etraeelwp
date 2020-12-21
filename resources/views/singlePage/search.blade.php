@extends('master.master_color')
@section('header')

@endsection
@section('content')

   <div class="questions">
       <div class="head">
           <h2>نتایج جست و جو برای : {{ $key }} </h2>
       </div>

       <div class="search_body">
         @if(count($searches) > 0)
          @foreach($searches as $search)
           <div class="search_item">
              <img src="{{$search->image}}" alt="">
              <div class="search_description">
                  @if(isset($search->name))
                      <a href="{{route('product.single',$search->id)}}">
                          <span class="search_description_name">{{$search->name}}</span>
                      </a>
                  @elseif(isset($search->title))
                      <a href="{{route('article.show',$search->id)}}">
                          <span class="search_description_name">{{$search->title}}</span>
                      </a>
                  @endif



                  @if(get_class($search) == 'App\Product')
                      <span class="search_description_cat"> دسته بندی محصولات</span>
                  @else
                      <span class="search_description_cat">مقالات</span>
                  @endif

                  <span class="search_description_descript">{{$search->description}}</span>
              </div>
          </div>
           @endforeach
           @else
             <span class="no_item">برای {{$key}} موردی یافت نشد !</span>
           @endif
       </div>

   </div>

@endsection
@section('script')

    <script>

    </script>
@endsection

