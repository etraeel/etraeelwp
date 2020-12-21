@component('profile.layouts.content')

    @slot('profileTitle')
        <span>داشبورد</span>
    @endslot

   <div class="index_items">
       <div class="index_item">
           <span class="index_item_title">نام و نام خانوادگی : </span>
           <span class="index_item_value">{{$user->name}}</span>
       </div>

       <div class="index_item">
           <span class="index_item_title">سطح دسترسی : </span>
           @if($user->is_admin())
               <span class="index_item_value">مدیر سایت</span>
           @elseif($user->is_stuff())
               <span class="index_item_value">کارمند</span>
           @else
           <span class="index_item_value">کاربر عادی</span>
           @endif
       </div>

       <div class="index_item">
           <span class="index_item_title">شماره موبایل : </span>
           <span class="index_item_value">{{$user->mobile}}</span>
       </div>

       <div class="index_item">
           <span class="index_item_title">آدرس ایمیل : </span>
           <span class="index_item_value">{{$user->email}}</span>
       </div>

       <div class="index_item">
           <span class="index_item_title">تعداد سفارشات : </span>
           <span class="index_item_value ">7</span>
       </div>

       <div class="index_item">
           <span class="index_item_title">تعداد پیام های خوانده نشده : </span>
           <span class="index_item_value value_red">{{count(\App\UserMessage::where('user_id' , $user->id)->where('status' , 0 )->get())}}</span>
       </div>

   </div>

@endcomponent
