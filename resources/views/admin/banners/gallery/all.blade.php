@component('admin.layouts.content' , ['title' => 'لیست بنر ها'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.admin')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item active">گالری بنر ها</li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">بنر ها</h3>

                    <div class="card-tools d-flex">
                        <div class="btn-group-sm mr-1">
                            <a href="{{ route('admin.banners.create')}}" class="btn btn-info">ثبت بنر جدید</a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        @foreach($banners as $banner)
                            <div class="col-sm-6  justify-content-center align-items-center border border-light p-4">
                                <a target="tab"  class="d-flex w-75 h-75" href="{{ url($banner->url) }}">
                                    <img  src="{{ url($banner->url) }}" class="img-fluid mb-2 rounded" alt="">
                                </a>
                                <form action="{{ route('admin.banners.destroy' , $id  = $banner->id) }}" id="url-{{ $banner->id }}" method="post">
                                    @method('delete')
                                    @csrf
                                </form>
                                <a  href="{{ route('admin.banners.edit' , $id  = $banner->id) }}" class="btn btn-sm btn-primary mr-4">ویرایش</a>
                                <a  href="#" class="btn btn-sm btn-danger" onclick="document.getElementById('url-{{ $banner->id }}').submit()">حذف</a>

                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">

                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endcomponent
