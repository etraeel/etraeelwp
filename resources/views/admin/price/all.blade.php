@component('admin.layouts.content',['title' => 'مدیریت قیمت ها'])
    @slot('breadcrumb')

        <li class="breadcrumb-item"><a href="{{route('admin.admin')}}">داشبورد</a></li>
        <li class="breadcrumb-item active">مدیریت قیمت ها</li>
    @endslot


    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">مدیریت قیمت ها</h3>

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
                        <th>آی دی</th>
                        <th>نام محصول</th>
                        <th>گروه</th>
                        <th>موجودی</th>
                        <th>قیمت</th>
                        <th>قیمت تخفیفی</th>
                        <th>اقدامات</th>
                    </tr>
                    @foreach($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td><a target="_blank" href="{{route('product.single' , $product->id)}}">{{$product->name}}</a></td>
                            <td>موبایل</td>
                            <td>{{$product->inventory()}}</td>
                            @if($product->price)
                                <td>{{$product->price->price}}</td>
                            @else
                                <td>قیمتی ثبت نشده است</td>
                            @endif

                            @if($product->price)
                                <td>{{$product->price->off_price}}</td>
                            @else
                                <td>قیمتی ثبت نشده است</td>
                            @endif

                               <td class="d-flex">
                                    <a class="btn btn-sm btn-primary " href="{{route('admin.price.singlePrice.edit' , $product)}}">مدیریت قیمت </a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">{{$products->render()}}</div>
        </div>
        <!-- /.card -->
    </div>


@endcomponent
