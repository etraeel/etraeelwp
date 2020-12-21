<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">


        <img src="{{asset('img/admin/AdminLTELogo.png')}}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">

        <span class="brand-text font-weight-light">پنل مدیریت</span>
    </a>

    <!-- Sidebar -->
    @php
        $user = \Illuminate\Support\Facades\Auth::user();
    @endphp
    <div class="sidebar" style="direction: ltr">
        <div style="direction: rtl">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{$user->pic_logo != null ? asset($user->pic_logo)  : asset('img/avatar.png')}}"
                         class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{$user->name}}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{route('admin.admin')}}" class="nav-link {{is_active('admin.admin')}}">
                            <i class="fas fa-tachometer-alt-slow"></i>
                            داشبورد
                        </a>
                    </li>
                    @can('users_show')
                    <li class="nav-item has-treeview {{is_active(['admin.users.index' , 'admin.users.index'] , 'menu-open')}}">
                        <a href="{{route('admin.users.index')}}" class="nav-link {{is_active('admin.users.index')}}">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                کاربران
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.users.index')}}"
                                   class="nav-link {{is_active('admin.users.index')}}">
                                    <i class="far fa-users-class"></i>
                                    <p>لیست کاربران</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                   @endcan
                    @canany(['permission'])
                        <li class="nav-item has-treeview {{ is_active(['admin.permissions.index', 'admin.roles.index'] , 'menu-open') }}">
                            <a href="#"
                               class="nav-link {{ is_active(['admin.permissions.index' , 'admin.roles.index']) }}">
                                <i class="nav-icon fa fa-users"></i>
                                <p>
                                    بخش اجازه دسترسی
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            @can('permission')
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.roles.index') }}"
                                           class="nav-link {{ is_active('admin.roles.index') }}">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>همه مقام ها</p>
                                        </a>
                                    </li>
                                </ul>
                            @endcan
                            @can('permission')
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.permissions.index') }}"
                                           class="nav-link {{ is_active('admin.permissions.index') }}">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>همه دسترسی ها</p>
                                        </a>
                                    </li>
                                </ul>
                            @endcan
                        </li>
                    @endcanany
                    @can('comments')
                        <li class="nav-item">
                            <a href="{{route('admin.comments.index')}}"
                               class="nav-link {{is_active('admin.comments.index')}}">
                                <i class="fal fa-comments-alt"></i>
                                مدیریت نظرات
                            </a>
                        </li>
                    @endcan
                    @can('orders')
                        <li class="nav-item has-treeview {{ is_active(['admin.orders.index',] , 'menu-open') }}">
                            <a href="#" class="nav-link {{ is_active(['admin.orders.index']) }}">
                                <i class="far fa-shopping-cart"></i>
                                <p>
                                    بخش سفارشات
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.orders.index' , ['type' => 'unpaid']) }}"
                                       class="nav-link {{ isUrl(route('admin.orders.index' , ['type' => 'unpaid'])) }} ">
                                        <i class="far fa-circle nav-icon text-warning"></i>
                                        <p>پرداخت نشده
                                            <span
                                                class="badge badge-warning right">{{ \App\Order::whereStatus('unpaid')->count() }}</span>
                                        </p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.orders.index' , ['type' => 'paid']) }}"
                                       class="nav-link {{ isUrl(route('admin.orders.index' , ['type' => 'paid'])) }}">
                                        <i class="far fa-circle nav-icon text-info"></i>
                                        <p>پرداخت شده
                                            <span
                                                class="badge badge-info right">{{ \App\Order::whereStatus('paid')->count() }}</span>
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.orders.index'  , ['type' => 'preparation']) }}"
                                       class="nav-link {{ isUrl(route('admin.orders.index' , ['type' => 'preparation'])) }}">
                                        <i class="far fa-circle nav-icon text-primary"></i>
                                        <p>در حال پردازش
                                            <span
                                                class="badge badge-primary right">{{ \App\Order::whereStatus('preparation')->count() }}</span>
                                        </p>
                                    </a>
                                </li>
                                {{--                            <li class="nav-item">--}}
                                {{--                                <a href="{{ route('admin.orders.index' , ['type' => 'posted']) }}" class="nav-link {{ isUrl(route('admin.orders.index' , ['type' => 'posted'])) }}">--}}
                                {{--                                    <i class="far fa-circle nav-icon text text-light"></i>--}}
                                {{--                                    <p>ارسال شده--}}
                                {{--                                        <span class="badge badge-light right">{{ \App\Order::whereStatus('posted')->count() }}</span>--}}
                                {{--                                    </p>--}}
                                {{--                                </a>--}}
                                {{--                            </li>--}}
                                {{--                            <li class="nav-item">--}}
                                {{--                                <a href="{{ route('admin.orders.index' , ['type' => 'received']) }}" class="nav-link {{ isUrl(route('admin.orders.index' , ['type' => 'received'])) }}">--}}
                                {{--                                    <i class="far fa-circle nav-icon text-success"></i>--}}
                                {{--                                    <p>دریافت شده--}}
                                {{--                                        <span class="badge badge-success right">{{ \App\Order::whereStatus('received')->count() }}</span>--}}
                                {{--                                    </p>--}}
                                {{--                                </a>--}}
                                {{--                            </li>--}}
                                <li class="nav-item">
                                    <a href="{{ route('admin.orders.index' , ['type' => 'canceled']) }}"
                                       class="nav-link {{ isUrl(route('admin.orders.index' , ['type' => 'canceled'])) }}">
                                        <i class="far fa-circle nav-icon text-danger"></i>
                                        <p>کنسل شده
                                            <span
                                                class="badge badge-danger right">{{ \App\Order::whereStatus('canceled')->count() }}</span>
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endcan
                    @can('articles_show')
                        <li class="nav-item">
                            <a href="{{route('admin.articles.index')}}"
                               class="nav-link {{is_active('admin.articles.index')}}">
                                <i class="fal fa-newspaper"></i>
                                مدیریت مقالات
                            </a>
                        </li>
                    @endcan
                    @can('discounts')
                        <li class="nav-item">
                            <a href="{{route('admin.discount.index')}}"
                               class="nav-link {{is_active('admin.discount.index')}}">
                                <i class="fas fa-percent"></i>
                                مدیریت تخفیف ها
                            </a>
                        </li>
                    @endcan
                    @can('banners')
                        <li class="nav-item has-treeview {{is_active(['admin.banners.sortBannersIndex' ,'admin.banners.index' ] , 'menu-open')}}">
                            <a href="#"
                               class="nav-link {{is_active(['admin.banners.sortBannersIndex' ,'admin.banners.index'])}}">
                                <i class="far fa-pennant"></i>
                                <p>
                                    مدیریت بنرها
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('admin.banners.index')}}"
                                       class="nav-link {{is_active('admin.banners.index')}}">

                                        <i class="nav-icon fa fa-dashboard"></i>
                                        ویرایش بنر ها
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{route('admin.banners.sortBannersIndex')}}"
                                       class="nav-link {{is_active('admin.banners.sortBannersIndex')}}">
                                        <i class="nav-icon fa fa-dashboard"></i>
                                        ترتیب بنرها
                                    </a>
                                </li>

                            </ul>
                        </li>
                    @endcan
                    @can('messages')
                    <li class="nav-item has-treeview {{is_active(['admin.message.index' ,'admin.receivedMessages' ] , 'menu-open')}}">
                        <a href="#" class="nav-link {{is_active(['admin.message.index' ,'admin.receivedMessages' ])}}">
                            <i class="far fa-envelope"></i>
                            <p>
                                پیام ها
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.message.index')}}"
                                   class="nav-link {{is_active('admin.message.index')}}">
                                    <i class="nav-icon fa fa-dashboard"></i>
                                    مدیریت اطلاع رسانی ها
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{route('admin.receivedMessages')}}"
                                   class="nav-link {{is_active('admin.receivedMessages')}}">
                                    <i class="nav-icon fa fa-dashboard"></i>
                                    پیام های دریافتی
                                </a>
                            </li>

                        </ul>
                    </li>
                    @endcan
                        {{--                    <li class="nav-item has-treeview {{is_active(['admin.settings.show' ,'admin.questions.show'] , 'menu-open')}}">--}}
                    {{--                        <a href="#" class="nav-link {{is_active(['admin.settings.show' ,'admin.questions.show'])}}">--}}
                    {{--                            <i class="fas fa-user-cog"></i>--}}
                    {{--                            <p>--}}
                    {{--                                 تنظیمات--}}
                    {{--                                <i class="right fa fa-angle-left"></i>--}}
                    {{--                            </p>--}}
                    {{--                        </a>--}}
                    {{--                        <ul class="nav nav-treeview">--}}
                    {{--                            <li class="nav-item">--}}
                    {{--                                <a href="{{route('admin.settings.show')}}" class="nav-link {{is_active('admin.settings.show')}}">--}}
                    {{--                                    <i class="far fa-circle nav-icon"></i>--}}
                    {{--                                    <p>کانفیگ سایت</p>--}}
                    {{--                                </a>--}}
                    {{--                            </li>--}}

                    {{--                            <li class="nav-item">--}}
                    {{--                                <a href="{{route('admin.questions.show')}}" class="nav-link {{is_active('admin.questions.show')}} ">--}}
                    {{--                                    <i class="far fa-circle nav-icon"></i>--}}
                    {{--                                    <p>سوالات متداول</p>--}}
                    {{--                                </a>--}}
                    {{--                            </li>--}}

                    {{--                        </ul>--}}
                    {{--                    </li>--}}

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
    </div>
    <!-- /.sidebar -->
</aside>




