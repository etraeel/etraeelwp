@extends('layouts.master_color')
@section('header')

@endsection
@section('content')

   <div class="questions">
       <div class="head">
           <h1>درباره ما</h1>
       </div>

       <div class="body">
           <span>{!!  $aboutUs_text->value !!}</span>
       </div>

   </div>

@endsection
@section('script')

    <script>

    </script>
@endsection

