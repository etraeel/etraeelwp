@component('admin.layouts.content',['title' => 'ایجاد مقاله جدید'])
    @slot('breadcrumb')

        <li class="breadcrumb-item"><a href="{{route('admin.admin')}}">داشبورد</a></li>
        <li class="breadcrumb-item"><a href="/admin/articles">لیست مقالات</a></li>
        <li class="breadcrumb-item active">ایجاد مقاله جدید</li>
    @endslot

    <!-- general form elements -->
    <div class="card card-primary col-12">
        <div class="card-header">
            <h3 class="card-title">ایجاد مقاله</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('admin.articles.store')}}" method="POST" role="form" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                @include('admin.layouts.errors')
                <div class="form-group ">
                    <label for="title">عنوان</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="عنوان را وارد کنید">
                </div>
                <div class="form-group ">
                    <label for="reading_time">مدت زمان لازم برای مطالعه</label>
                    <input type="text" class="form-control" name="reading_time" id="reading_time" placeholder="مدت زمان به دقیقه وارد کنید ">
                </div>

                <div class="form-group ">
                    <label for="key_words">کلمات کلیدی</label>
                    <input type="text" class="form-control" name="key_words" id="key_words" placeholder="کلمات کلیدی را وارد کنید">
                </div>
                <div class="form-group ">
                    <label for="image">تصویر مقاله</label>
                    <input type="file" class="form-control" name="image" id="image" >
                </div>

                <div class="form-group ">
                    <label for="description">توضیحات</label>
                    <textarea class="form-control"  name="description" id="description" placeholder="توضیحات را وارد کنید . . ."></textarea>
                </div>

                <div class="form-group ">
                    <label for="editor">متن</label>
                    <textarea class="form-control"  name="text" id="editor" placeholder="متن خود را وارد کنید . . ."></textarea>
                </div>



            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" id="submit" class="btn btn-primary">ایجاد مقاله</button>
            </div>
        </form>
    </div>
    <!-- /.card -->

@section('script')
    <script>
        CKEDITOR.replace('editor', {filebrowserImageBrowseUrl: '/file-manager/ckeditor'});
    </script>
@endsection


@endcomponent
