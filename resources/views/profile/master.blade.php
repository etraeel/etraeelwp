@extends('master/master')

@yield('head')
@section('content')

<div class="profile">

    <aside>
        @include('profile.layouts.sidebar')
    </aside>
    <div class="profile_content">

           {{$slot ?? ''}}

    </div>

</div>

@endsection

@yield('script')
