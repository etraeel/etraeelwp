<div class="profile_info">
    @php
      $user = \Illuminate\Support\Facades\Auth::user();
    @endphp
    <img src="{{$user->pic_logo != null ? asset($user->pic_logo)  : asset('img/avatar.png')}}" alt="profile avatar">
    <div class="profile_description">
        <span class="profile_name">{{$user->name}}</span>
        <span class="profile_email">{{$user->email}}</span>
        <span class="profile_mobile">{{$user->mobile}}</span>
    </div>
</div>
<div class="items">
    <div class="item {{is_active('profile.index')}}">
        <a href="{{route('profile.index')}}">
            <i class="fad fa-id-card"></i>
            <span>داشبورد</span>
        </a>
    </div>
    <div class="item {{is_active('profile.edit')}}">
        <a href="{{route('profile.edit')}}">
            <i class="fad fa-id-card"></i>
            <span>ویرایش پروفایل</span>
        </a>
    </div>
    <div class="item {{is_active(['profile.sendMessage' ,'profile.messages' ,'profile.showMessage'])}}">
        <a href="{{route('profile.messages')}}">
            <i class="fad fa-envelope"></i>
            <span>پیام ها</span>
        </a>
    </div>
{{--    <div class="item {{is_active(['profile.orders' ,'profile.showOrder'])}}">--}}
{{--        <a href="{{route('profile.orders')}}">--}}
{{--            <i class="fad fa-dollar-sign"></i>--}}
{{--            <span>سفارشات</span>--}}
{{--        </a>--}}
{{--    </div>--}}
{{--    <div class="item ">--}}
{{--        <a href="">--}}
{{--            <i class="fad fa-tags"></i>--}}
{{--            <span>محصولات خریداری شده</span>--}}
{{--        </a>--}}
{{--    </div>--}}
    @if(Auth::user()->is_admin() OR Auth::user()->is_stuff())
        <div class="item">
            <a href="{{route('admin.admin')}}">
                <i class="fad fa-user-shield"></i>
                <span>پنل مدیریت</span>
            </a>
        </div>
    @endif


</div>
