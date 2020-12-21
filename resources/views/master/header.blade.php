
<header>
    <div class="header__1">

        <ul class="m1280">
            <li>
                <a href="">
                    <i class="far fa-shopping-basket"></i>
                </a>
            </li>

            <li>
                <div class="user_login" >

                    @if(auth()->check())
                        <img src="{{auth()->user()->pic_logo != null ? auth()->user()->pic_logo : asset('/img/avatar.png')}}" alt="">
                        {{--                <i class="far fa-user"></i>--}}
                        <a  href="{{route('profile.index')}}"><span>  پنل کاربری  {{ auth()->user()->name }}</span></a>
                        /
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button><span>خروج</span></button>
                        </form>

                    @else
                        <i class="far fa-user"></i>
                        <a href="{{route('login')}}"><span>ورود</span></a>
                        /
                        <a href="{{route('register')}}"><span style="color: #e8505b">عضویت</span></a>
                    @endif

                </div>

{{--                @if(auth()->check())--}}
{{--                    @if(auth()->user()->is_supper_user)--}}
{{--                        <div class="btnn btnn-red"><a href="{{route('admin.admin')}}">پنل مدیریت</a></div>--}}
{{--                    @endif--}}
{{--                @endif--}}

{{--                @if(\Illuminate\Support\Facades\Auth::check())--}}
{{--                    <form method="POST" action="{{ route('logout') }}">--}}
{{--                        @csrf--}}
{{--                      <button class="btnn">خروج</button>--}}
{{--                    </form>--}}
{{--                @else()--}}
{{--                    <a href="{{ route('register') }}" name="signin">عضویت</a>--}}
{{--                    <i class="fas fa-user-unlock"></i>--}}
{{--                    <a href="{{ route('login') }}">ورود</a>--}}
{{--                @endif--}}


            </li>
            <li style="display: none">
                <a href="{{route('contactUs')}}">ارتباط با ما</a>
                <a style="display: none" href="">کانال تلگرام</a>

            </li>

        </ul>


    </div>
    <img id="site-logo" src="{{asset('img/logo.png')}}" alt="">
    <div class="header__2">
        <i id="menu-icon" class="fad fa-bars"></i>
        <div class="menu" hidden>
            <ul>
                <li>
                    <form id="search_header_2" action="{{route('search')}}" method="post">
                        @csrf
                        <input type="text" name="key" placeholder="دنبال چی میگردی؟">
                        <i @click="document.getElementById('search_header_2').submit()" class="far fa-search"></i>
                    </form>
                </li>
                <li><a href="{{route('home')}}">صفحه اصلی </a></li>
                <li><a href="#">فروشگاه</a></li>
                <li><a href="#">خرید هاست</a></li>
                <li><a href="#">سرویس پیامک</a></li>
                <li><a href="{{route('articles')}}">مقالات</a></li>
                @auth()
                    <li><a href="{{route('profile.index')}}">پروفایل</a></li>
                @endauth
                @guest()
                    <li><a href="{{route('login')}}">ورود / عضویت</a></li>
                @endguest
                <li><a href="#">کانال تلگرام</a></li>
                <li><a href="{{route('aboutUs')}}">درباره ما</a></li>
                <li><a href="{{route('contactUs')}}">ارتباط با ما</a></li>
            </ul>
        </div>

    </div>
    <div class="header__3" style="display: none">
        <ul>
            <li><a href="{{route('home')}}">صفحه اصلی </a></li>
            <li><a href="#">فروشگاه</a></li>
            <li><a href="#">خرید هاست</a></li>
            <li><a href="#">سرویس پیامک</a></li>
            <li><a href="{{route('articles')}}">مقالات</a></li>
        </ul>
    </div>
    <div class="header__4" style="display: none">
        <form id="search_header_2" action="{{route('search')}}" method="post">
            @csrf
            <input type="text" name="key" placeholder="دنبال چی میگردی؟">
            <i @click="document.getElementById('search_header_2').submit()" class="far fa-search"></i>
        </form>
    </div>

    @if(\Illuminate\Support\Facades\Route::current()->getName() == null or \Illuminate\Support\Facades\Route::current()->getName() == 'home')

        <div class="header__5">
            <div class="introduction">
                <span>در دنیایی که اینترنت تمامی نیازهای آنها را برطرف میکند، طراحی صفحات وب و ارائه خدمات متنوع از طریق آن به بالاترین درجه اهمیت خود رسیده است. کسب‌و‌کارهایی که در فضای وب فعالیت مناسبی ندارند محکوم به شکست هستند و طراحی وبسایت احتمالا مهم‌ترین بخش پیشرفت یک کسب‌و‌کار در فصای آنلاین را نشان می‌دهد. مجموعه ما با بهره‌گیری از حرفه‌ای‌ترین برنامه‌نویسان ایران، سعی در ارائه خلاقانه‌ترین طراحی صفحات وب برای شما را دارد. ارائه سرویس‌ها و خدمات آنلاین از طریق وب و پشتیبانی مداوم، تضمین کننده تعهد ما برای رسیدن به کیفیت مورد نظر شماست.</span>
            </div>
        </div>

    @endif

</header>
