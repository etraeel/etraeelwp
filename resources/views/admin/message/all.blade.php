@component('admin.layouts.content',['title' => 'پیام ها'])
    @slot('breadcrumb')

        <li class="breadcrumb-item"><a href="{{route('admin.admin')}}">داشبورد</a></li>
        <li class="breadcrumb-item active">پیام ها</li>
    @endslot


    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">پیام ها</h3>

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
                        <a style="color: #fff" href="{{route('admin.message.create')}}">ارسال پیام جدید</a>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <th>فرستنده</th>
                        <th>سمت</th>
                        <th>عنوان</th>
                        <th>تاریخ ایجاد</th>
                        <th>اقدامات</th>
                    </tr>
                    @foreach($messages as $message)
                        <tr>
                            <td>{{ \App\User::find($message->sender)->name}}</td>
                            <td>{{ \App\User::find($message->sender)->type == 'admin' ? 'مدیر سایت' : 'کارمند سایت'}}</td>
                            <td>{{$message->title}}</td>
                            <td>{{jdate($message->created_at)->format('%A, %d %B %y')}}</td>

                            <td class="d-flex">
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#exampleModalLong{{$message->id}}">
                                    مشاهده
                                </button>

                                <form method="get" action="{{route('admin.message.edit' , $id  = $message->id)}}">
                                    <button class="btn btn-sm btn-warning mr-2" type="submit">ویرایش</button>
                                </form>

                                <form method="POST" action="{{route('admin.message.destroy' , $id  = $message->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger mr-2" type="submit">حذف</button>
                                </form>

                                <!-- Modal -->
                                <div class="modal fade mt-5 " id="exampleModalLong{{$message->id}}" tabindex="-1"
                                     role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog mw-80" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header align-items-center justify-content-start">
                                                <button type="button" class="close ml-2" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <h5 class="modal-title"
                                                    id="exampleModalLongTitle">{{$message->title}}</h5>
                                            </div>
                                            <div class="modal-body">
                                                <span>{!! $message->text !!}</span>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    بستن
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>

            <!-- Button trigger modal -->


            <!-- /.card-body -->
            <div class="card-footer">{{$messages->render()}}</div>

        </div>
        <!-- /.card -->
    </div>

@section('script')
    <script>
        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        })
    </script>
@endsection

@endcomponent
