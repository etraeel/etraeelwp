@component('admin.layouts.content' , ['title' => 'لیست سفارشات'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="/admin">پنل مدیریت</a></li>
        <li class="breadcrumb-item active"><a href="/admin/orders?search={{ $order->id }}">سفارش شماره {{ $order->id }} </a></li>
        <li class="breadcrumb-item active">لیست سفارشات</li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">لیست سفارشات</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>آیدی محصول</th>
                            <th>نام محصول</th>
                            <th>ویژگی محصول</th>
                            <th>تعداد محصول</th>
                        </tr>

                        @foreach($prices as $price)
                            <tr>
                                <td>{{ $price->product->id }}</td>
                                <td>{{ $price->product->name }}</td>
                                ‌@if($price->attribute != 0 )
                                    <td>{{ \App\Attribute::find($price->attribute)->name  . ' : ' . \App\AttributeValue::find($price->value)->value }}</td>
                                @else()
                                    <td>بدون ویژگی</td>
                                @endif
                                <td>{{ $price->pivot->quantity }}</td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {{ $prices->render() }}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endcomponent
