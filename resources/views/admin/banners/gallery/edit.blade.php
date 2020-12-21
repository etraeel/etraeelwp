@component('admin.layouts.content' , ['title' => 'ویرایش بنر'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.admin')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item"><a href="{{route('admin.banners.index')}}">مدیریت بنر ها</a></li>
        <li class="breadcrumb-item active">ویرایش بنر</li>
    @endslot

    @section('script')
        <script>
            // input
            let image;
            $('body').on('click','.button-image' , (event) => {
                event.preventDefault();

                image = $(event.target).closest('.image-field');

                window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
            });

            // set file link
            function fmSetLink($url) {
                image.find('.image_label').first().val($url);
            }
        </script>
    @endsection

    <div class="row">
        <div class="col-lg-12">
            @include('admin.layouts.errors')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">ویرایش بنر</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{ route('admin.banners.update' , $id  = $banner->id) }}" method="POST">
                    @csrf
                    @method('patch')

                    <div class="card-body">
{{--                        <h6>ویژگی محصول</h6>--}}
{{--                        <hr>--}}
                        <div id="images_section">
                            <div class="row image-field">
                                <div class="col-5">
                                    <div class="form-group">
                                        <label>تصویر</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control image_label" name="url" value="{{ old('url' , $banner->url) }}"
                                                   aria-label="Image" aria-describedby="button-image">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary button-image" type="button">انتخاب</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="form-group">
                                        <label>لینک :</label>
                                        <input type="text" name="link" class="form-control" value="{{ old('link' , $banner->link) }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ویرایش بنر</button>
                        <a href="{{ route('admin.banners.index') }}" class="btn btn-default float-left">لغو</a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>



@endcomponent
