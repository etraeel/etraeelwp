@extends('master.master_color')
@section('header')

@endsection
@section('content')

   <div class="questions">
       <div class="head">
           <h1>سوالات متداول</h1>
       </div>

       <div class="body">
           <span>{!!  $questions_text->value !!}</span>
       </div>

   </div>

@endsection
@section('script')

    <script>

    </script>
@endsection

