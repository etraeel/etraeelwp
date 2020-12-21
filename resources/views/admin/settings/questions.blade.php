@component('admin.layouts.content',['title' => 'ویرایش سوالات متداول'])
    @slot('breadcrumb')

        <li class="breadcrumb-item"><a href="/admin">داشبورد</a></li>
        <li class="breadcrumb-item"><a href="/admin/articles">تنظیمات</a></li>
        <li class="breadcrumb-item active">ویرایش سوالات متداول</li>
    @endslot

    <!-- general form elements -->
    <div class="card card-primary col-12">
        <div class="card-header">
            <h3 class="card-title">ویرایش بخش سوالات متداول</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('admin.questions.update')}}" method="POST" role="form">
            @csrf
            @method('PATCH')
            <div class="card-body">
                @include('admin.layouts.errors')

                <div class="form-group ">
                    <label for="editor">متن</label>
                    <textarea lang="en"  class="form-control"  name="text" id="editor" >{!!   \App\Setting::where('name' , 'question')->first()->value!!}</textarea>
                </div>



            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">ویرایش </button>
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
