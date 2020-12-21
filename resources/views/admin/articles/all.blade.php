@component('admin.layouts.content',['title' => 'لیست مقالات'])
    @slot('breadcrumb')

        <li class="breadcrumb-item"><a href="{{route('admin.admin')}}">داشبورد</a></li>
        <li class="breadcrumb-item active">لیست مقالات</li>
    @endslot


    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">لیست مقالات</h3>

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
                        <a style="color: #fff" href="{{route('admin.articles.create')}}">ایجاد مقاله جدید</a>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <th>آی دی</th>
                        <th>عنوان</th>
                        <th>نویسنده</th>
                        <th>تاریخ ایجاد</th>
                        <th>مشاهده</th>
                        <th>اقدامات</th>
                    </tr>
                    @foreach($articles as $article)
                        <tr>
                            <td>{{$article->id}}</td>
                            <td><a target="_blank" href="{{route('article.show' , $id = $article->id)}}">{{$article->title}}</a></td>
                            <td>{{$article->writer}}</td>
                            <td>{{jdate($article->created_at)->format('%A, %d %B %y')}}</td>
                            <td>{{$article->counter}}</td>

                            <td class="d-flex">
                                <form method="POST" action="{{route('admin.articles.destroy' , $id  = $article->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger ml-2" type="submit">حذف</button>
                                </form>

                                <a class="btn btn-sm btn-primary "
                                   href="{{route('admin.articles.edit' , $id  = $article->id)}}">ویرایش</a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">{{$articles->render()}}</div>
        </div>
        <!-- /.card -->
    </div>


@endcomponent
