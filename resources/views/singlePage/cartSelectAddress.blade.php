@extends('master.master_color')
@section('header')

@endsection
@section('content')

    <div id="app" class="cartAddress">

        <div class="head">
            <h1>انتخاب آدرس </h1>
            <form method="post" action="{{route('cart.payment')}}" id="cart_payment">
                @csrf
                @if(count($addresses) > 0)
                    @foreach($addresses as $address)
                        @if($address->default_address == 1)
                            <input type="hidden" id="address_selected" name="address_selected" value="{{$address->id}}">
                        @endif
                    @endforeach
                @endif
                <button
                    {{$addresses->count() > 0 ? '' : 'disabled'}} style="{{$addresses->count() > 0 ? '' : "background-color: #666666;cursor: no-drop"}}"
                    class="btnn btnn-red" type="submit">ورود به صفحه پرداخت
                </button>
            </form>
        </div>

        <div class="body">

            <h2>لطفا آدرس خود را انتخاب کنید</h2>

            <div class="Address_section">
                @if(count($addresses) > 0)
                    @foreach($addresses as $address)
                        <div class="address_item_parent">
                            <div class="address_item {{$address->default_address == 1 ? 'select_address' : ''}} ">
                                <div class="selected_address"></div>
                                <input type="hidden" value="{{$address->id}}">
                                <span>استان :  <span>   {{ $address->province->name }}  &nbsp; </span> شهر : <span> {{$address->city->name}} &nbsp; </span>  نشانی : <span>  {{$address->description}} &nbsp; </span> کد پستی : <span> {{$address->postal_code}}&nbsp; </span> شماره تماس : <span>  {{$address->home_number}}  </span></span>
                            </div>
                        </div>
                    @endforeach
                @endif


                <div class="add_address">
                    <h2>افزودن آدرس جدید :</h2>
                    <form id="addAddress" action="{{route('profile.addAddress')}}" method="post">
                        @csrf
                        <div class="add_address_item">
                            <label class="add_address_item_title">استان : </label>
                            <select class="js-example-basic-single" style="width: 200px; height: 50px" id="province"
                                    name="province_id">
                                @foreach(\App\Province::all() as $province)
                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="city_section" class="add_address_item">
                            <label class="add_address_item_title">شهر : </label>
                            <select id="cities" style="width: 200px; height: 50px" class="js-example-basic-single"
                                    name="city_id">

                            </select>
                        </div>
                        <div class="add_address_item">
                            <label class="add_address_item_title">آدرس پستی : </label>
                            <textarea name="description" cols="40" rows="3"></textarea>
                        </div>
                        <div class="add_address_item">
                            <label class="add_address_item_title">کد پستی : </label>
                            <input name="postal_code" type="number">
                        </div>
                        <div class="add_address_item">
                            <label class="add_address_item_title">شماره تماس : </label>
                            <input name="home_number" type="number">
                        </div>
                    </form>
                    <div onclick="document.getElementById('addAddress').submit()" class="btnn add_address_btn">افزودن
                        آدرس جدید
                    </div>

                </div>
            </div>

        </div>


    </div>
@endsection
@section('script')

    <script>
        var cities = [];
        axios.get('/profile/getcities')
            .then(response => {
                cities = response.data
            })
            .catch(function (error) {
                console.log(error);
            })


        $('#city_section').fadeOut(0);
        $('#province').on('select2:select', function (e) {
            var province = this.value;

            document.getElementById("cities").innerHTML = '';

            cities.forEach(myFunction);

            function myFunction(item, index) {
                if (item['province_id'] == province) {
                    document.getElementById("cities").innerHTML += '<option value=' + item['id'] + '>' + item['name'] + '</option>'
                }
            }

            $('#city_section').fadeIn(1000);

        });


        $('.address_item').click(function () {
            $('#address_selected').val($(this).children('input')[0].value);
            $('.address_item').css({'border': '2px solid rgba(0,0,0,0.1)'});
            $(this).css({'border': '2px solid rgba(7, 51, 227, 0.6)'});
            window.FlashMessage.success('آدرس مورد نظر انخاب شد !', {
                progress: true,
                timeout: 3000,
            });
        })
    </script>
@endsection

