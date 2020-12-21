@component('admin.layouts.content',['title' => 'پیام ها'])
    @slot('breadcrumb')

        <li class="breadcrumb-item"><a href="{{route('admin.admin')}}">داشبورد</a></li>
        <li class="breadcrumb-item active">پیام ها دریافتی</li>
    @endslot


    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">پیام ها دریافتی</h3>

                <div class="card-tools d-flex">
                    <form action="">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="search" class="form-control float-right" placeholder="جستجو">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>

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
                            <td>{{ \App\User::find($message->sender)->type == 'stuff' ? 'کارمند' : 'کاربر عادی'}}</td>
                            <td>{{$message->title}}</td>
                            <td>{{jdate($message->created_at)->format('%A, %d %B %y')}}</td>

                            <td class="d-flex">
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#exampleModalLong{{$message->id}}">
                                    مشاهده
                                </button>

{{--                                <form method="get" action="{{route('admin.message.edit' , $id  = $message->id)}}">--}}
{{--                                    <button class="btn btn-sm btn-warning mr-2" type="submit">ویرایش</button>--}}
{{--                                </form>--}}

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
                                                <button id="show_replay" type="button" class="btn btn-warning show_replay" >
                                                    پاسخ به پیام
                                                </button>
                                            </div>
                                            <form id="replay_form" class="d-none" action="{{route('admin.replay')}}" method="post">
                                                @csrf
                                                <div class="form-group p-2">
                                                    <label for="replay">پاسخ :</label>
                                                    <textarea name="replay" class="form-control" id="replay" rows="3"></textarea>
                                                    <input type="hidden" name="id" value="{{$message->id}}">
                                                    <button disabled id="btn_submit" type="submit" class="btn btn-primary mb-2 mt-2">ارسال</button>
                                                </div>
                                            </form>
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


        $('.show_replay').on('click', function () {
            $(this).parents('.modal-content').children('#replay_form').toggleClass('d-block');
        })


        $('#replay').on('keydown', function () {

            if($('#replay').val().length > 0){
                    $('#btn_submit').prop( "disabled", false );
            }else if($('#replay').val().length < 1){
                    $('#btn_submit').prop( "disabled", true );
            }
        })


    </script>
@endsection

@endcomponent
