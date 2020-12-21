@extends('master.master_color')
@section('header')

@endsection
@section('content')

    <div id="app" class="cart">

        @if(count(\Cart::all()) > 0 )
            <div class="cart_list">
                <div class="head">
                    <h1>سبد خرید <span class="products_count">0</span></h1>
                </div>

                <div class="body">

                    <div class="items">
                        @foreach(\Cart::all() as $cart)
                            @if($cart['price'])
                                @php
                                    $product = $cart['price']->product;
                                @endphp
                                <div class="item">
                                    <div class="prices" data-prices="{{ json_encode($product->prices)}}"></div>
                                    <img src="{{asset($product->image)}}" alt="">
                                    <div class="details">
                                        <span class="name">{{$product->name}}</span>
                                        <input type="hidden" class="cart_id" value="{{$cart['id']}}">
                                        <div class="attributes">
                                            <span>{{$product->description}}</span>
                                            {{--                                @if($product->attributes)--}}
                                            {{--                                    @foreach($product->attributes->take(3) as $attr)--}}
                                            {{--                                        <span>{{$attr->name}} : {{$attr->pivot->value->value}}</span>/--}}
                                            {{--                                    @endforeach--}}
                                            {{--                                @endif--}}

                                        </div>

                                        <div class="price_off">
                                            <span>تخفیف</span>
                                            <span
                                                class="price_off_number">{{ $cart['price']->price - $cart['price']->off_price * $cart['quantity'] }}</span>
                                            <input class="price_off_hidden" type="hidden" type="text"
                                                   value="{{$cart['price']->price - $cart['price']->off_price}}">
                                            <span>تومان</span>
                                        </div>

                                        <div class="control">

                                            @if(count($product->prices) > 1)
                                                <div class="inventory">
                                                    <span>{{\App\Attribute::find($product->prices[0]->attribute)->name}} : </span>

                                                    <div class="pricesBox">
                                                        <select>
                                                            @foreach($product->prices as $price)
                                                                @if($price->inventory > 0)
                                                                    <option
                                                                        {{$price->id == $cart['price']->id ? 'selected' : ''}} value="{{$price->value}}">{{\App\AttributeValue::find($price->value)->value}}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>
                                            @endif

                                            <div class="inventory">
                                                <span>تعداد : </span>

                                                <div class="box">
                                                    <select>
                                                        @foreach(range(1 , $cart['price']->inventory ) as $item)
                                                            @if($item <= 5 && $item > 0)
                                                                <option
                                                                    value="{{$item}}" {{$cart['quantity'] == $item ? 'selected' : ''}}>{{$item}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="delete">
                                                <i class="fad fa-trash-alt"></i>
                                                <span>حذف</span>
                                            </div>

                                        </div>
                                        <div class="price">
                                            <span
                                                class="price_number">{{$cart['price']->price * $cart['quantity']}}</span>
                                            <input class="price_number_hidden" type="hidden" type="text"
                                                   value="{{$cart['price']->price}}">
                                            <span>تومان</span>
                                        </div>

                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="cart_factor">
                <div class="head">
                    <h1>فاکتور نهایی </h1>
                </div>

                <div class="body">
                    <div class="price_products">
                        <span>قیمت کالا ها (<span class="products_item_count">0</span> قلم )</span>
                        <span class="translate">@{{this.price_products}}<span
                                class="margin_currency"> تومان </span></span>
                    </div>

                    <div class="price_transport">
                        <span>هزینه ارسال</span>
                        <span>0<span class="margin_currency">تومان</span></span>
                    </div>

                    <div class="price_total">
                        <span>جمع</span>
                        <span>@{{this.price_total}}<span class="margin_currency">تومان</span></span>
                    </div>

                    <div class="price_off">
                        <span>تخفیف کالا ها</span>
                        <span>@{{this.price_off}}<span class="margin_currency">تومان</span></span>
                    </div>

                    <div class="price_pay">
                        <span>مبلغ قابل پرداخت</span>
                        <span>@{{this.price_pay}}<span class="margin_currency">تومان</span></span>
                    </div>

                    <div class="discount_section">
                        <span> کد تخفیف :</span>
                        <input id="discount_code" class="inp" type="text">
                        <div id="submit_discount" class="btnn btnn-green">بررسی</div>
                    </div>
                    <span id="discount_status"></span>

                    <div class="continue_pay btnn">
                        <form method="get" action="{{route('cart.selectAddress')}}" id="cart_payment">
                            {{--                        <input type="hidden" id="discount" name="discount" value="nullDiscount">--}}
                        </form>
                        <span onclick="document.getElementById('cart_payment').submit()">ادامه فرآیند پرداخت</span>
                    </div>


                </div>
            </div>

        @endif


    </div>
    @if(count(\Cart::all()) < 1 )
        <div class="empty_cart">
            <div class="head">
                <h1>سبد خرید </h1>
            </div>

            <div class="body">
                <img src="/img/empty_basket.png" alt="">
                <span>سبد خرید شما خالی است!</span>

            </div>
        </div>
    @endif
@endsection
@section('script')

    <script>
        let app = new Vue({
            el: '#app',
            data: {
                price_products: 0,
                price_transport: 0,
                price_total: 0,
                price_off: 0,
                price_pay: 0,
            },
            mounted() {
                this.refresh_price_product()
                this.refresh_count_product()


                $('.pricesBox').change(function () {

                    let prices = $(this).parents('.item').find('.prices').data('prices');

                    priceSelected = searchObjectsInArray(prices, 'value', $(this).find('select').val());


                    $(this).parents('.item').find('.price_number_hidden').val(priceSelected['price']);
                    $(this).parents('.item').find('.price_off_hidden').val(priceSelected['price'] - priceSelected['off_price']);

                    $(this).parents('.item').find('.box select').children().remove();
                    $(this).parents('.item').find('.box select').append(createNewList(priceSelected['inventory']));


                    $(this).parents('.item').find('.price_number').text(
                        1 * $(this).parents('.item').find('.price_number_hidden').val()
                    )

                    $(this).parents('.item').find('.price_off_number').text(
                        1 * $(this).parents('.item').find('.price_off_hidden').val()
                    )

                    app.refresh_price_product()
                    app.refresh_count_product()

                    $data = {
                        id: $(this).parents('.item').find('.cart_id').val(),
                        price: priceSelected['id'],
                    }

                    axios.patch('/cart/update', $data)
                        .then(response => console.log(response.data))
                        .catch(function (error) {
                            console.log(error);
                        })


                })

                $('.box').change(function () {
                    $(this).parents('.item').find('.price_number').text(
                        $(this).find('select').val() * $(this).parents('.item').find('.price_number_hidden').val()
                    )

                    $(this).parents('.item').find('.price_off_number').text(
                        $(this).find('select').val() * $(this).parents('.item').find('.price_off_hidden').val()
                    )

                    app.refresh_price_product()
                    app.refresh_count_product()

                    $data = {
                        id: $(this).parents('.item').find('.cart_id').val(),
                        quantity: $(this).find('select').val()
                    }

                    axios.patch('/cart/update', $data)
                        .then(response => console.log(response.data))
                        .catch(function (error) {
                            console.log(error);
                        })
                })

                $('.delete').click(function () {
                    $(this).parents('.item').remove();

                    app.refresh_price_product()
                    app.refresh_count_product()

                    $data = {
                        id: $(this).parents('.item').find('.cart_id').val(),
                    }

                    axios.patch('/cart/delete', $data)
                        .then(response => console.log(response.data))
                        .catch(function (error) {
                            console.log(error);
                        })

                })

                $('#submit_discount').click(function () {
                    let code = $('#discount_code').val();
                    app.check_discount(code);
                })

                let searchObjectsInArray = (arraylist, checkWithValue, inputValue) => {
                    let priceObject = {}
                    arraylist.map(function (item) {
                        Object.entries(item).forEach(([key, value]) => {
                            if (key == checkWithValue && value == inputValue) {
                                priceObject = item;
                            }
                        });
                    })
                    return priceObject;
                }
                let createNewList = (inventory) => {

                    let newList = ``;

                    for (var i = 1; i <= inventory; i++) {

                        if (i < 6) {
                            if (i == 1) {
                                newList += '<option selected value="' + 1 + '">' + 1 + '</option>';
                            } else {
                                newList += '<option value="' + i + '">' + i + '</option>';
                            }

                        }

                    }
                    return newList;
                }
            },
            methods: {
                check_discount: function (code) {
                    $data = {
                        code: code,
                    }

                    axios.post('/discount/check/)', $data)
                        .then(response => {
                                if (response.data['price_pay'] != null) {
                                    this.price_pay = response.data['price_pay'];
                                    console.log(response.data['price_pay'])
                                    // $('#discount').val($('#discount_code').val());
                                } else {
                                    this.price_pay = this.price_total - this.price_off;
                                }
                                $('#discount_status').text(response.data['status']);
                            }
                        )
                        .catch(function (error) {
                            console.log(error);
                        })
                },
                refresh_price_product: function () {
                    price_products = 0;
                    $('.price_number').each(function () {
                        price_products += parseFloat($(this).text());
                    });

                    this.price_products = price_products;


                    var price_off = 0;
                    $('.price_off_number').each(function () {
                        price_off += parseFloat($(this).text());
                    });

                    this.price_off = price_off;

                    this.price_total = this.price_products - this.price_transport;

                    this.price_pay = this.price_total - this.price_off;


                },
                refresh_count_product: function () {

                    var products_count = $('.item').length;
                    $('.products_count').text(products_count);


                    $('.products_item_count').text(do_change_products_item);

                    function do_change_products_item() {
                        var sum = 0;
                        $('select :selected').each(function () {
                            sum += Number($(this).val());
                        });
                        return sum;
                    }
                }
            }

        })
    </script>
@endsection

