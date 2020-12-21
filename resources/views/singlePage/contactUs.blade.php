@extends('master.master_color')
@section('header')

@endsection
@section('content')

   <div class="questions">
       <div class="head">
           <h1>ارتباط با ما</h1>
       </div>

       <div class="body">
           <span>{!!  $contactUs_text->value !!}</span>
       </div>

   </div>

@endsection
@section('script')

    <script>

    </script>
@endsection

