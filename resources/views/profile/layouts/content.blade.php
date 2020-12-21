@component('profile.master')
    <div class="profile_header">
        {{$profileTitle}}
    </div>

    <div class="profile_body">
        {{$slot ?? ''}}
    </div>

@endcomponent

@section('script')
    {{ $script ?? '' }}
@endsection

@section('head')
    {{ $head ?? '' }}
@endsection

