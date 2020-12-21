@component('admin.layouts.content',['title' => 'ارسال پیام جدید'])
    @slot('breadcrumb')

        <li class="breadcrumb-item"><a href="{{route('admin.admin')}}">داشبورد</a></li>
        <li class="breadcrumb-item"><a href="{{route('admin.message.index')}}">لیست پیام ها</a></li>
        <li class="breadcrumb-item active">ارسال پیام جدید</li>
    @endslot

    <!-- general form elements -->
    <div class="card card-primary col-12">
        <div class="card-header">
            <h3 class="card-title">ایجاد پیام جدید</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('admin.message.store')}}" method="POST" role="form" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                @include('admin.layouts.errors')
                <div class="form-group ">
                    <label for="sender">فرستنده</label>
                    <input disabled type="text" class="form-control" value="{{\Illuminate\Support\Facades\Auth::user()->name}}">
                    <input type="hidden" class="form-control" name="sender" id="sender" value="{{\Illuminate\Support\Facades\Auth::user()->id}}">
                </div>

                <div class="form-group mt-4">
                    <input type="checkbox"  id="send_to_all"  data-size="lg">
                    <label  for="send_to_all">ارسال به همه</label>
                </div>

                <div id="receivers_list" class="form-group">
                    <label for="receivers[]" class="col-sm-2 control-label mt-1">گیرنده</label>
                    <select class="form-control" name="receivers[]" id="receivers" multiple>
                        @foreach(\App\User::all() as $user)
                            @if($loop->first)
                                <option hidden value="ALL">ALL</option>
                            @endif
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group ">
                    <label for="title">عنوان</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="عنوان را وارد کنید">
                </div>

                <div class="form-group ">
                    <label for="editor">متن</label>
                    <textarea class="form-control"  name="text" id="editor" placeholder="متن خود را وارد کنید . . ."></textarea>
                </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" id="submit" class="btn btn-primary">ارسال پیام</button>
            </div>
        </form>
    </div>
    <!-- /.card -->

@section('script')
    <script>

        CKEDITOR.replace('editor', {filebrowserImageBrowseUrl: '/file-manager/ckeditor'});

        $('#send_to_all').on('change' , function () {
            $('#receivers_list').fadeToggle(500);
            $('#receivers_list').children('select').val('ALL');
        })

    </script>
@endsection


@endcomponent
