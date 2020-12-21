@component('admin.layouts.content',['title' => 'ویرایش پیام'])
    @slot('breadcrumb')

        <li class="breadcrumb-item"><a href="{{route('admin.admin')}}">داشبورد</a></li>
        <li class="breadcrumb-item"><a href="{{route('admin.message.index')}}">لیست پیام ها</a></li>
        <li class="breadcrumb-item active">ویرایش پیام</li>
    @endslot

    <!-- general form elements -->
    <div class="card card-primary col-12">
        <div class="card-header">
            <h3 class="card-title">ویرایش پیام </h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('admin.message.update' , $message->id)}}" method="POST" role="form" >
            @csrf
            @method('patch')
            <div class="card-body">
                @include('admin.layouts.errors')
                <div class="form-group ">
                    <label for="sender">فرستنده</label>
                    <input disabled type="text" class="form-control" value="{{ \App\User::find($message->sender)->name}}">
                    <input type="hidden" class="form-control" name="sender" id="sender" value="{{$message->sender}}">
                </div>


                <div class="form-group ">
                    <label for="title">عنوان</label>
                    <input type="text" class="form-control" name="title" value="{{$message->title}}" id="title" >
                </div>

                <div class="form-group ">
                    <label for="editor">متن</label>
                    <textarea class="form-control"  name="text" id="editor" >{!! $message->text !!}</textarea>
                </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" id="submit" class="btn btn-primary">ویرایش پیام</button>
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
