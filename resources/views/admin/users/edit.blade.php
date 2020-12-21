@component('admin.layouts.content',['title' => 'ویرایش کاربر '])
    @slot('breadcrumb')

        <li class="breadcrumb-item"><a href="/admin">داشبورد</a></li>
        <li class="breadcrumb-item"><a href="/admin/users">لیست کاربران</a></li>
        <li class="breadcrumb-item active">ویرایش کاربر</li>
    @endslot

    <!-- general form elements -->
    <div class="card card-primary col-5">
        <div class="card-header">
            <h3 class="card-title">ویرایش کاربر</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('admin.users.update' , ['user' => $user->id])}}" method="POST" role="form">
            @csrf
            @method('PATCH')
            <div class="card-body">
                @include('admin.layouts.errors')
                <div class="form-group ">
                    <label for="name">نام کاربر</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="نام کاربر را وارد کنید"
                           value="{{$user->name}}">
                </div>

                <label for="email">آدرس ایمیل</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                    </div>
                    <input type="email" class="form-control" name="email" id="email" placeholder="ایمیل را وارد کنید"
                           value="{{$user->email}}">
                </div>

                <div class="form-group">
                    <label for="mobile">شماره موبایل</label>
                    <input type="text" class="form-control" name="mobile" id="molile"
                           placeholder="شماره موبایل را وارد کنید" value="{{$user->mobile}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">رمز عبور</label>
                    <input type="text" name="password" class="form-control"  id="exampleInputPassword1"
                           placeholder="رمز عبور را وارد کنید">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword2">تایید رمز عبور</label>
                    <input type="text" class="form-control"  name="password_confirmation" id="exampleInputPassword2"
                           placeholder="پسورد را وارد کنید">
                </div>

                <div class="form-group">
                    <label>سطح دسترسی</label>
                    <select name="type" class="form-control">
                        <option value="user">کاربر عادی</option>
                        <option {{($user->type == 'admin')? 'selected' : ''}} value="admin">مدیر سایت</option>
                        <option {{($user->type == 'stuff')? 'selected' : ''}} value="stuff">کارمند سایت</option>
                    </select>
                </div>

                <div class="form-check">
                    <input {{($user->email_verified_at)? 'checked' : ''}} type="checkbox" name="verify" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">احراز هویت انجام شده</label>
                </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">ویرایش کاربر</button>
            </div>
        </form>
    </div>
    <!-- /.card -->



@endcomponent
