@component('admin.layouts.content',['title' => 'تنظیمات'])
    @slot('breadcrumb')

        <li class="breadcrumb-item"><a href="{{route('admin.admin')}}">داشبورد</a></li>
        <li class="breadcrumb-item active">تنظیمات</li>
    @endslot


    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">تنظیمات</h3>
            </div>
            <!-- /.card-header -->

                <form action="{{route('admin.settings.update')}}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        @include('admin.layouts.errors')
                        <div class="form-group ">
                            <label for="site_name">نام سایت :</label>
                            <input type="text" class="form-control" name="site_name" id="site_name" value="{{\App\Setting::where('name','site_name')->first()->value}}" placeholder="نام سایت را وارد کنید . . ." >
                        </div>
                        <div class="form-group ">
                            <label for="site_phone_number">شماره تماس :</label>
                            <input type="text" class="form-control" name="site_phone_number" id="site_phone_number" value="{{\App\Setting::where('name','site_phone_number')->first()->value}}" placeholder="شماره تماس را وارد کنید . . . ">
                        </div>

                        <div class="form-group ">
                            <label for="site_email">ایمیل :</label>
                            <input type="text" class="form-control" name="site_email" id="site_email" value="{{\App\Setting::where('name','site_email')->first()->value}}" placeholder="ایمیل را وارد کنید . . .">
                        </div>


                        <div class="input-group align-items-center mt-lg-5">
                            <label for="site_logo">تصویر لوگو سایت :</label>
                            <input type="text" id="site_logo" class="form-control mr-3" name="site_logo"
                                   aria-label="Image" aria-describedby="button-image" value="{{\App\Setting::where('name','site_logo')->first()->value}}">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="button-image">انتخاب</button>
                            </div>
                        </div>
                        <img class="img-bordered mt-4 mr-4" src="{{asset(\App\Setting::where('name','site_logo')->first()->value)}}" alt="{{\App\Setting::where('name','site_name')->first()->value}}">

                        <div class="form-group mt-5 ">
                            <label for="site_contact_us">ارتباط با ما</label>
                            <textarea class="form-control"  name="site_contact_us" id="site_contact_us" placeholder="متن خود را وارد کنید . . .">{!!  \App\Setting::where('name','site_contact_us')->first()->value!!}</textarea>
                        </div>
                        <div class="form-group ">
                            <label for="site_about_us">درباره ما</label>
                            <textarea class="form-control"  name="site_about_us" id="site_about_us" placeholder="متن خود را وارد کنید . . .">{!!  \App\Setting::where('name','site_about_us')->first()->value!!}</textarea>
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" id="submit" class="btn btn-primary">ویرایش تنظیمات</button>
                    </div>
                </form>

        </div>
        <!-- /.card -->
    </div>

@section('script')
    <script>
        CKEDITOR.replace('site_contact_us', {filebrowserImageBrowseUrl: '/file-manager/ckeditor'});
        CKEDITOR.replace('site_about_us', {filebrowserImageBrowseUrl: '/file-manager/ckeditor'});


        document.addEventListener("DOMContentLoaded", function() {

            document.getElementById('button-image').addEventListener('click', (event) => {
                event.preventDefault();

                window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
            });
        });

        function fmSetLink($url) {
            document.getElementById('site_logo').value = $url;
        }
    </script>
@endsection

@endcomponent
