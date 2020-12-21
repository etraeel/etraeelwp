@extends('.master/master_color')

@section('content')
    <div class="reset_password">

        <span>لطفا رمز عبور جدید خود را وارد نمایید:</span>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input class="inp" type="hidden" name="token" value="{{ $token }}">

            <input class="inp" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                   value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

            @error('email')
            <span class="invalid-feedback" role="alert">
                 <strong>{{ $message }}</strong>
            </span>
            @enderror

            <input class="inp"  type="password" placeholder="رمز عبور جدید خود را وارد نمایید . . " class="form-control @error('password') is-invalid @enderror"
                   name="password" required autocomplete="new-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
            </span>
            @enderror

               <input class="inp" type="password" placeholder="رمز عبور جدید خود را مجددا وارد نمایید . . " name="password_confirmation" required autocomplete="new-password">


            <button type="submit" class="btn">
                ذخیره تغییرات
            </button>

        </form>

    </div>



@endsection
