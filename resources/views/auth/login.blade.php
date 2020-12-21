@extends('.master/master_color')

@section('content')

    <div class="login">

        <div class="head">
            <span>اگر حساب کاربری ندارید ثبت نام کنید :</span>
            <div class="btnn"><a href="{{route("register")}}">ایجاد حساب کاربری</a></div>

        </div>
        <div class="body">
            <span>اگر حساب کاربری دارید وارد شوید  :</span>
            <form action="{{route("login")}}" method="POST">
                @csrf
                <input class="inp" name="email" type="text" placeholder="ایمیل خود را وارد کنید . .">
                <input class="inp" name="password" type="password" placeholder="پسورد خود را وارد کنید . .">

                @recaptcha
                @error('g-recaptcha-response')
                    <span >{{ $message }}</span>
                @enderror

                <button class="btnn" type="submit">ورود</button>
                @if(\Illuminate\Support\Facades\Route::has('password.request'))
                    <a  href="{{route('password.request')}}">آیا رمز خود را فراموش کرده اید؟</a>

                @endif

            </form>
        </div>
    </div>

@endsection
