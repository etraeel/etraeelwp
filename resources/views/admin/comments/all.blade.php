@component('admin.layouts.content',['title' => 'لیست کامنت های تایید نشده'])
    @slot('breadcrumb')

        <li class="breadcrumb-item"><a href="{{route('admin.admin')}}">داشبورد</a></li>
        <li class="breadcrumb-item active">لیست کامنت ها</li>
    @endslot

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">لیست کامنت ها</h3>

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
                    <tr >
                        <th>آی دی</th>
                        <th>نام کاربر</th>
                        <th>گروه</th>
                        <th>موضوع</th>
                        <th>زمان ثبت</th>
                        <th class="col-sm-8 col-md-10 col-lg-12 d-flex justify-content-center"  style="min-width: 300px">متن نظر</th>
                        <th>اقدامات</th>
                    </tr>
                    @foreach($comments as $comment)
                        <tr>
                            <td>{{$comment->id}}</td>
                            <td>
                                @if(! $comment->user->name == '')
                                    {{$comment->user->name}}
                                @else
                                    {{$comment->user->email}}
                                @endif
                            </td>
                            <td>
                                @if($comment->commentable_type == "App\Product")
                                    محصولات
                                @elseif($comment->commentable_type == "App\Article")
                                    مقالات
                                @endif
                            </td>
                            <td><a target="tab" href="{{route('product.single' , $comment->commentable)}}"> {{$comment->commentable->name}}</a></td>
                            <td>{{jdate($comment->created_at)->ago()}}</td>
                            <td >
                                <textarea class="w-100 ">
                                    {{$comment->comment}}
                                </textarea>

                            </td>
                            <td class="d-flex">
                                <form method="POST" action="{{route('admin.comments.destroy' , $comment =  $comment->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger ml-2" type="submit">حذف</button>
                                </form>

                                <form method="POST" action="{{route('admin.comments.update' , $comment)}}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-sm btn-primary ml-2" type="submit">تایید</button>
                                </form>

                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">{{$comments->render()}}</div>
        </div>
        <!-- /.card -->
    </div>


@endcomponent
