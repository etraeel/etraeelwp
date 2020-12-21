@component('profile.layouts.content')

    @slot('profileTitle')
        <span>پیام ها</span>
        <div class="btnn btnn-red"><a href="{{route('profile.sendMessage')}}">ارسال پیام</a></div>
    @endslot

   <div class="messages_items">
       @if($messages->count() < 1)
           <div class="messages_item">
               <div class="messages_item_description">
                   <span>پیامی جهت نمایش وجود ندارد</span>
               </div>
           </div>
       @endif
      @foreach($messages as $message)
       <div class="messages_item {{$message->status === 1 ? 'seened' : ''}}">
          <div class="messages_item_description">
             @if($message->status === 0 or $message->status === 1)
                  @if($message->status === 0)
                      <i class="fad fa-envelope"></i>
                  @elseif($message->status === 1)
                      <i class="fad fa-envelope-open"></i>
                 @endif
             @else
                      <i class="fad fa-user-shield"></i>
             @endif

              <span>{{jdate($message->created_at)->format('%A, %d %B %y')}}</span>
              <span>{{ \App\User::find($message->sender)->type == 'admin' ? 'مدیر سایت' : 'کارمند سایت'}}</span>
              <span>{{$message->title}}</span>

          </div>

          <div class="messages_item_options">
              <form action="{{route('profile.showMessage')}}" method="post">
                  @csrf
                  <input type="hidden" name="id" value="{{$message->id}}">
                  <input type="hidden" name="option" value="{{$message->status === 0 or $message->status === 1 ? true : false}}">
                  <input class="input_btn" type="submit" value="مشاهده">
              </form>

          </div>
      </div>
       @endforeach

   </div>

@endcomponent
