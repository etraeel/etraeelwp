@component('admin.layouts.content',['title' => 'ویرایش محصول'])
    @slot('breadcrumb')

        <li class="breadcrumb-item"><a href="{{route('admin.admin')}}">داشبورد</a></li>
        <li class="breadcrumb-item"><a href="{{route('admin.price.all')}}">لیست محصولات</a></li>
        <li class="breadcrumb-item active">ویرایش محصول</li>
    @endslot

    <!-- general form elements -->
    <div class="card card-primary col-12">
        <div class="card-header">
            <h3 class="card-title">ویرایش محصول</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        {{--        <div id="attributes" data-attributes="{{ json_encode(\App\Attribute::all()->pluck('name')) }}"></div>--}}
        <div id="values"
             data-values="{{ json_encode(\App\AttributeValue::where('attribute_id' , $product->prices()->first()->attribute)->pluck('value')) }}"></div>
        <form action="{{route('admin.price.multiPrice.update' , $product)}}" method="POST" role="form">
            @csrf
            <div class="card-body">
                @include('admin.layouts.errors')
                <div class="row">
                    <div class="col-6">
                        <label for="name">عنوان</label>
                        <input type="text" disabled class="form-control" name="name" id="name"
                               value="{{$product->name}}">
                    </div>
                    <div class="col-6" id="attribute_section">
                        {{--                        @if($product->prices->count() > 1)--}}
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>عنوان ویژگی</label>
                                    <select name="attribute"
                                            onchange="changeAttributeValues(event);"
                                            class="attribute-select form-control">
                                        <option value="">انتخاب کنید</option>
                                        @foreach(\App\Attribute::all() as $attr)
                                            <option
                                                value="{{ $attr->name }}" {{ $attr->id == $product->prices->first()->attribute ? 'selected' : '' }}>{{ $attr->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <h6 class="mt-3">سایر قیمت ها</h6>
                <hr class="mb-5" style="border: 2px solid #d9d6d6">

                <div id="prices_items">
                    @foreach($product->prices as $item)
                        <div id="prices_item-{{ $loop->index }}">
                            <input type="hidden" name="prices_item[{{ $loop->index }}][id]" value="{{$item->id}}">
                            <div class="row">
                                <div class="col-6">
                                    <lable>قیمت پیشفرض</lable>
                                    <input class="mr-2 price_status" onchange="changePricesStatus(event);"
                                           name="prices_item[{{ $loop->index }}][status]"
                                           type="checkbox"
                                           value="{{$item->status == 1 ? 1 : 0}}" {{$item->status == 1 ? 'checked' : ''}}>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-sm btn-warning float-left"
                                            {{--                                            onclick="document.getElementById('prices_item-{{ $loop->index }}').remove()">--}}
                                            onclick="delete_item('prices_item-{{ $loop->index }}')">
                                        حذف
                                    </button>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group ">
                                        <label>ویژگی محصول</label>
                                        <select name="prices_item[{{ $loop->index }}][value]"
                                                class="attribute-select form-control">
                                            <option value="" selected>انتخاب کنید</option>
                                            @foreach(\App\AttributeValue::where('attribute_id' , $product->prices()->first()->attribute)->get() as $value)
                                                <option
                                                    value="{{$value->value}}" {{$value->id == $item->value ? 'selected' : ''}}>{{$value->value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group ">
                                        <label for="inventory">موجودی</label>
                                        <input type="number" class="form-control"
                                               name="prices_item[{{ $loop->index }}][inventory]" id="inventory"
                                               value="{{$item->inventory}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="price">قیمت</label>
                                    <input type="number" class="form-control"
                                           name="prices_item[{{ $loop->index }}][price]" id="price"
                                           value="{{$item->price}}">
                                </div>
                                <div class="col-6">
                                    <label for="off_price"> قیمت تخفیف خورده</label>
                                    <input type="number" class="form-control"
                                           name="prices_item[{{ $loop->index }}][off_price]" id="off_price"
                                           value="{{$item->off_price}}">
                                </div>
                            </div>
                            <hr class="mb-5" style="border: 2px dotted #d0d0d0">
                        </div>
                    @endforeach
                </div>

                <button class="btn btn-sm btn-danger float-left" type="button" id="add_price">ایجاد زیر قیمت جدید
                </button>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">اعمال قیمت ها</button>
            </div>
        </form>
    </div>
    <!-- /.card -->
    @slot('script')
        <script>

            let delete_item = (item) => {
                let el = $('#' + item)
                let status = el.find('input[name *= "[status]"]')

                el.remove();
                if(status.val() == 1){

                    $('.price_status')[0].value = 1
                    $('.price_status')[0].checked = true
                }
            }

            let createNewPrice = ({index, price_values}) => {

                return `
                   <div id="prices_item-${index}">
                            <input type="hidden" name="prices_item[${index}][id]" value="-1">
                            <div class="row">
                                <div class="col-6">
                                    <lable>قیمت پیشفرض</lable>
                                    <input class="mr-2 price_status" onchange="changePricesStatus(event);" name="prices_item[${index}][status]"
                                           type="checkbox"  value="0" >
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-sm btn-warning float-left"
                                            onclick="document.getElementById('prices_item-${index}').remove()">
                                        حذف
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group ">
                                        <label>ویژگی محصول</label>
                                        <select name="prices_item[${index}][value]"
                                                class="attribute-select form-control">
                                            <option value="" selected>انتخاب کنید</option>
${
                    price_values.map(function (val) {
                        return `<option value="${val}" >${val}</option>`
                    })

                }

                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group ">
                <label for="inventory">موجودی</label>
                <input type="number" class="form-control"
                       name="prices_item[${index}][inventory]" id="inventory"
                                               value="0">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="price">قیمت</label>
                                    <input type="number" class="form-control"
                                           name="prices_item[${index}][price]" id="price"
                                           value="0">
                                </div>
                                <div class="col-6">
                                    <label for="off_price"> قیمت تخفیف خورده</label>
                                    <input type="number" class="form-control"
                                           name="prices_item[${index}][off_price]" id="off_price"
                                           value="0">
                                </div>
                            </div>
                            <hr class="mb-5" style="border: 2px dotted #d0d0d0">
                        </div>
`
            }

            let changePricesStatus = (event) => {

                $('.price_status').each(function (index, el) {
                    el.value = 0
                    el.checked = false
                });
                event.target.value = 1
                event.target.checked = true

            }

            $('#add_price').click(function () {
                let prices_items = $('#prices_items');
                let index = prices_items.children().length;
                let price_values = $('#values').data('values')

                prices_items.append(
                    createNewPrice({index, price_values})
                );

                $('.attribute-select').select2({tags: true});
            });

            let changeAttributeValues = (event) => {
                let valueBox = $(`select[name*='[value]']`);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json'
                    }
                })
                //
                $.ajax({
                    type: 'POST',
                    url: '/admin/attribute/values',
                    data: JSON.stringify({
                        name: event.target.value
                    }),
                    success: function (res) {

                        $('#values').data('values', res.data)
                        $('#values').attr('data-values', res.data)

                        valueBox.html(`
                            <option value="" selected>انتخاب کنید</option>
                            ${
                            res.data.map(function (item) {
                                return `<option value="${item}">${item}</option>`
                            })
                        }
                        `);
                    }
                });
            }

            $('.attribute-select').select2({tags: true});
        </script>
    @endslot


@endcomponent
