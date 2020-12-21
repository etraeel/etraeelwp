@component('profile.layouts.content')

    @slot('profileTitle')
        <span>سفارشات شما</span>
    @endslot

    <div class="order_items">
        @foreach($orders as $order)
            <div class="order_item">

                <div class="header">
                    <span>شماره سفارش : <span>{{$order->id}}/</span></span>
                    <span>تاریخ : <span>{{jdate($order->updated_at)->format('%A, %d %B %y')}}/</span></span>
                    @if($order->status == 'unpaid')
                        <span>وضعیت : <span style="color: #fa5c5c">پرداخت نشده/</span></span>
                    @elseif($order->status == 'paid')
                        <span>وضعیت : <span style="color: #39d67d">پرداخت شده/</span></span>
                    @elseif($order->status == 'preparation')
                        <span>وضعیت : <span style="color: #ff9900">درحال آماده سازی/</span></span>
                    @elseif($order->status == 'posted')
                        <span>وضعیت : <span style="color: #2b64d4">ارسال شده/</span></span>
                    @elseif($order->status == 'received')
                        <span>وضعیت : <span style="color: #39d67d">دریافت شده/</span></span>
                    @elseif($order->status == 'canceled')
                        <span>وضعیت : <span style="color: #e70309">لغو شده/</span></span>
                    @endif
                    <span>مبلغ : <span>{{$order->price}} تومان</span></span>
                    <div style="display: inline-block" class="btnn">جزئیات</div>
                </div>
                <div class="description" hidden>
                    @foreach($order->prices as $price)
                        <div class="description_item">

                            <img src="{{asset($price->product->image)}}" alt="{{$price->product->name}}">
                            <div>
                                <a class="product_name" target="tab" href="/product/+product.id">
                                    <span id="product_name">{{$price->product->name}}</span>
                                </a>
                                @if($price->attribute != 0)
                                    <div class="products_item_details">
                                        <span>{{\App\Attribute::find($price->attribute)->name}} : </span>
                                        <span>{{\App\AttributeValue::find($price->value)->value ?? ''}}</span>
                                    </div>
                                @endif
                                <div class="products_item_details">
                                    <span>تعداد :</span>
                                    <span>{{$price->pivot->quantity}} عدد </span>
                                </div>
                                <div class="products_price">
                                    <span class="number">{{$price->off_price}}</span>
                                    <span class="unit">تومان</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        @endforeach

    </div>

@endcomponent
