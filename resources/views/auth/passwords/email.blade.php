@extends('master/master_color')

@section('content')
    <div class="email_reset">
        <h2>بازیابی رمز عبور:</h2>

        @if (session('status'))
            <div style="color: #12a000" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <input class="inp" type="email" placeholder="لطفا ایمیل خود را وارد کنید . . "
                   @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required
            autocomplete="email" autofocus>
            @error('email')
            <span style="color: #ff2020" role="alert">
                                        <strong>{{ $message }}</strong>
                            </span>
            @enderror

            @recaptcha
            @error('g-recaptcha-response')
            <span>{{ $message }}</span>
            @enderror

            <button type="submit" class="btn">
                دریافت ایمیل بازیابی رمز عبور
            </button>

        </form>
    </div>

@endsection

