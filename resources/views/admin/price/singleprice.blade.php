@component('admin.layouts.content',['title' => 'ویرایش قیمت محصول'])
    @slot('breadcrumb')

        <li class="breadcrumb-item"><a href="{{route('admin.admin')}}">داشبورد</a></li>
        <li class="breadcrumb-item"><a href="{{route('admin.price.all')}}">لیست محصولات</a></li>
        <li class="breadcrumb-item active">ویرایش قیمت محصول</li>
    @endslot

    <!-- general form elements -->
    <div class="card card-primary col-12">
        <div class="card-header">
            <h3 class="card-title">ویرایش قیمت محصول</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('admin.price.singlePrice.update' , $product)}}" method="POST" role="form">
            @csrf
            <div class="card-body">
                @include('admin.layouts.errors')
                <div class="form-group ">
                    <label for="name">عنوان</label>
                    <input type="text" disabled class="form-control" name="name" id="name" value="{{$product->name}}">
                </div>

                <div class="form-group ">
                    <label for="inventory">موجودی</label>
                    <input type="number" {{$product->prices->count() > 1 ? 'disabled' : ''}} class="form-control" name="inventory" id="inventory" value="{{$product->inventory()}}">
                </div>

                @if($product->prices->count() < 2)
                <div class="form-group ">
                    <label for="price"> قیمت (تومان)</label>
                    <input type="number" class="form-control" name="price" id="price" value="{{$product->price->price ?? 0}}">
                </div>
                <div class="form-group ">
                    <label for="off_price"> قیمت تخفیف خورده (تومان)</label>
                    <input type="number" class="form-control" name="off_price" id="off_price"
                           value="{{$product->price->off_price ?? 0}}">
                </div>
                @endif
                <h6>سایر قیمت ها</h6>
                <hr>


                    <a class="btn btn-sm btn-danger float-left" href="{{route('admin.price.multiPrice.edit' , $product)}}">مدیریت چند قیمتی</a>


            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                @if($product->prices->count() < 2  )
                    <button type="submit" class="btn btn-primary">ویرایش قیمت</button>
                @endif
            </div>
        </form>
    </div>
    <!-- /.card -->
    @slot('script')

    @endslot

@endcomponent
