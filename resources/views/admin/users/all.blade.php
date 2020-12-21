@component('admin.layouts.content',['title' => 'لیست کاربران'])
    @slot('breadcrumb')

        <li class="breadcrumb-item"><a href="{{route('admin.admin')}}">داشبورد</a></li>
        <li class="breadcrumb-item active">لیست کاربران</li>
    @endslot


    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">لیست کاربران</h3>

                <div class="card-tools d-flex">
                    <form action="">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="search" class="form-control float-right" placeholder="جستجو">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>

                    <div class="btn btn-info mr-3">
                        <a style="color: #fff" href="{{route('admin.users.create')}}">ایجاد کاربر جدید</a>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <th>آی دی</th>
                        <th>نام کاربر</th>
                        <th>شماره موبایل</th>
                        <th>ایمیل</th>
                        <th>تاریخ عضویت</th>
                        <th>وضعیت</th>
                        <th>سطح دسترسی</th>
                        <th>اقدامات</th>
                    </tr>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->mobile}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{jdate($user->created_at)->format('%A, %d %B %y')}}</td>
                            <td>
                                @if($user->email_verified_at)
                                    <span class="badge badge-success">احراز هویت شده</span>
                                @else
                                    <span class="badge badge-danger">احراز هویت نشده</span>
                                @endif
                            </td>

                            <td>
                                @if($user->is_admin())
                                    <span class="badge badge-danger">مدیر سایت</span>
                                @elseif($user->is_stuff())
                                    <span class="badge badge-info">کارمند سایت</span>
                                @else
                                    <span class="badge badge-success">کاربر عادی</span>
                                @endif
                            </td>
                            <td class="d-flex">
                                <form method="POST" action="{{route('admin.users.destroy' , ['user' =>  $user->id])}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger ml-2" type="submit">حذف کاربر</button>
                                </form>

                                <a class="btn btn-sm ml-2 btn-primary "
                                   href="{{route('admin.users.edit' , ['user' =>  $user->id])}}">ویرایش کاربر</a>
                                @if( $user->is_stuff())
                                    @can('permission')
                                        <a href="{{ route('admin.users.permissions' , $user->id) }}" class="btn btn-sm btn-warning">دسترسی ها</a>
                                    @endcan
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">{{$users->render()}}</div>
        </div>
        <!-- /.card -->
    </div>


@endcomponent
