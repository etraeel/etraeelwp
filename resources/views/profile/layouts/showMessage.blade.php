@component('profile.layouts.content')

    @slot('profileTitle')
        <span>مشاهده پیام</span>
        <div style="float: left" class="btnn"><a href="{{route('profile.messages')}}">بازگشت</a></div>
    @endslot

   <div class="show_message">
       <span>{!! $message->text !!}</span>

   </div>

@endcomponent
