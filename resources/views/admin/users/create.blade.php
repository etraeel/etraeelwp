@component('admin.layouts.content',['title' => 'ایجاد کاربر جدید'])
    @slot('breadcrumb')

        <li class="breadcrumb-item"><a href="/admin">داشبورد</a></li>
        <li class="breadcrumb-item"><a href="/admin/users">لیست کاربران</a></li>
        <li class="breadcrumb-item active">ایجاد کاربر جدید</li>
    @endslot

    <!-- general form elements -->
    <div class="card card-primary col-5">
        <div class="card-header">
            <h3 class="card-title">ایجاد کاربر</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('admin.users.store')}}" method="POST" role="form">
            @csrf
            <div class="card-body">
                @include('admin.layouts.errors')
                <div class="form-group ">
                    <label for="name">نام کاربر</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="نام کاربر را وارد کنید">
                </div>

                <label for="email">آدرس ایمیل</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                    </div>
                    <input type="email" class="form-control" name="email" id="email" placeholder="ایمیل را وارد کنید">
                </div>

                <div class="form-group">
                    <label for="mobile">شماره موبایل</label>
                    <input type="text" class="form-control" name="mobile" id="molile" placeholder="شماره موبایل را وارد کنید">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">رمز عبور</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="رمز عبور را وارد کنید">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword2">تایید رمز عبور</label>
                    <input type="password" class="form-control" name="password_confirmation" id="exampleInputPassword2" placeholder="پسورد را وارد کنید">
                </div>

                <div class="form-group">
                    <label>سطح دسترسی</label>
                    <select name="type" class="form-control">
                        <option value="user">کاربر عادی</option>
                        <option  value="stuff">کارمند سایت</option>
                        <option value="admin">مدیر سایت</option>
                    </select>
                </div>

                <div class="form-check">
                    <input type="checkbox" name="verify" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">احراز هویت انجام شده</label>
                </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">ایجاد کاربر</button>
            </div>
        </form>
    </div>
    <!-- /.card -->



@endcomponent
