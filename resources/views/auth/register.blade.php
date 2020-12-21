@extends('master/master_color')

@section('content')

{{--    @if( DB::connection())--}}
{{--        <h1>sucsecc</h1>--}}
{{--    @endif--}}
    <div class="register">
        <div class="head">
            <h1 class="h">فرم عضویت</h1>
            <h3 class="h">در عرض چند ثانیه در وب پکس عضو شوید تا بتوانید از امکانات سایت بصورت کامل استفاده کنید . همه این امکانات در کنار هم قرار گرفته اند تا به شما کمک کنند برای سفارش سایت خود بهتر تصمیم گیری کنید</h3>


        </div>
        <div class="body">
        <span >اطلاعات کاربری</span>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div >{{$error}}</div>
                @endforeach
            @endif


            <form method="POST" action="{{route("register")}}">
                @csrf
                <input class="inp" type="text" name="name" placeholder="نام خود را وارد کنید . .">
                <input class="inp" type="text" name="email" placeholder="ایمیل خود را وارد کنید . .">
                <input class="inp" type="text" name="mobile" placeholder="موبایل خود را وارد کنید . .">
                <input class="inp" type="password" name="password" placeholder="پسورد خود را وارد کنید . .">
                <input class="inp" type="password" name="password_confirmation" placeholder="تایید پسورد خود را وارد کنید . . ">
                @recaptcha
                @error('g-recaptcha-response')
                <span >{{ $message }}</span>
                @enderror

                <button class="btnn" type="submit">ثبت نام</button>
            </form>
        </div>
    </div>

@endsection
