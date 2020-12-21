@component('admin.layouts.content' , ['title' => 'ویرایش کد تخفیف'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="/admin">پنل مدیریت</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.discount.index') }}">لیست تخفیف‌ها</a></li>
        <li class="breadcrumb-item active">ویرایش کد تخفیف</li>
    @endslot

    @slot('script')
        <script>

            $('#users').select2({
                'placeholder' : 'محصول مورد نظر را انتخاب کنید'
            })

            $('#products').select2({
                'placeholder' : 'محصول مورد نظر را انتخاب کنید'
            })

            $('#categories').select2({
                'placeholder' : 'دسته مورد نظر را انتخاب کنید'
            })

            $('#expired_at_show').MdPersianDateTimePicker({
                enableTimePicker: true,
                textFormat: 'yyyy/MM/dd HH:mm:ss',
                dateFormat: 'yyyy/MM/dd HH:mm:ss',
                targetTextSelector: '#expired_at_show',
                targetDateSelector: '#expired_at',



            });
        </script>
    @endslot

    <div class="row">
        <div class="col-lg-12">
            @include('admin.layouts.errors')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">فرم ویرایش کد تخفیف</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{ route('admin.discount.update' , $discount->id) }}" method="POST">
                    @csrf
                    @method('patch')

                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-5 control-label">کد تخفیف</label>
                            <input type="text" name="code" class="form-control" id="inputEmail3" placeholder="کد تخفیف را وارد کنید" value="{{ old('code' , $discount->code) }}">
                        </div>
                        <div class="form-group">
                            <label for="precent" class="col-sm-5 control-label">میزان تخفیف (درصد)</label>
                            <input type="number" name="percent" class="form-control" placeholder="درصد تخفیف را وارد کنید" value="{{ old('percent' , $discount->percent) }}">
                        </div>

                        <div class="form-group">
                            <label for="number_discount_fixed" class="col-sm-3 control-label">تعداد تخفیف (اختیاری )</label>
                            <label for="withoutLimitNumberDiscount" class="ml-1 control-label">بدون محدودیت</label>
                            <input type="checkbox" onclick="document.getElementById('number_discount_fixed').toggleAttribute('disabled');document.getElementById('number_discount_fixed').setAttribute('value' , null);" id="withoutLimitNumberDiscount" placeholder="بدون محدودیت">
                            <input type="number" name="number_discount_fixed" id="number_discount_fixed"  class="form-control" placeholder="{{ $discount->number_discount_fixed == -1 ? 'بدون محدودیت' : ''}}" value="{{ $discount->number_discount_fixed == -1 ? null : $discount->number_discount_fixed}}">
                        </div>

                        <div class="form-group">
                            <label for="max_discount_price" class="col-sm-3 control-label">حداکثر مبلغ تخفیف (به تومان) (اختیاری )</label>
                            <label for="unlimitedDiscountPrice" class="ml-1 control-label">بدون محدودیت</label>
                            <input type="checkbox" onclick="document.getElementById('max_discount_price').toggleAttribute('disabled');document.getElementById('max_discount_price').setAttribute('value' , null);" id="unlimitedDiscountPrice" placeholder="بدون محدودیت">
                            <input type="number" name="max_discount_price" id="max_discount_price" class="form-control" placeholder="{{ $discount->max_discount_price == 0 ? 'بدون محدودیت' : ''}}" value="{{ $discount->max_discount_price == 0 ? null : $discount->max_discount_price}}">
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label">کاربر مربوط به تخفیف (اجباری)</label>
                            <select class="form-control" name="users[]" id="users" multiple>
                                <option value="null" {{ ! $discount->users->count() ? 'selected' : '' }}>همه کاربرها</option>
                                @foreach(\App\User::all() as $user)
                                    <option value="{{ $user->id }}" {{ in_array($user->id , $discount->users->pluck('id')->toArray() ) ? 'selected' : '' }}>{{ $user->email }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">محصول مربوطه (اجباری)</label>
                            <select class="form-control" name="products[]" id="products" multiple>
                                <option value="null" {{ ! $discount->products->count() ? 'selected' : '' }}>همه محصول</option>
                                @foreach(\App\Product::all() as $product)
                                    <option value="{{ $product->id }}" {{ in_array($product->id , $discount->products->pluck('id')->toArray() ) ? 'selected' : '' }}>{{ $product->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">دسته‌بندی مربوطه (اجباری)</label>
                            <select class="form-control" name="categories[]" id="categories" multiple>
                                <option value="null" {{ ! $discount->categories->count() ? 'selected' : '' }}>همه دسته‌ها</option>
                                @foreach(\App\Category::all() as $category)
                                    <option value="{{ $category->id }}" {{ in_array($category->id , $discount->categories->pluck('id')->toArray() ) ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
{{--                        <div class="form-group">--}}
{{--                            <label for="inputEmail3" class="col-sm-3 control-label"> مهلت استفاده (اجباری)</label>--}}
{{--                            <input type="datetime-local" name="expired_at" class="form-control" id="inputEmail3" placeholder="ملهت استفاده را وارد کنید" value="{{ old('expired_at' , \Carbon\Carbon::parse($discount->expired_at)->format('Y-m-d\TH:i:s')) }}">--}}
{{--                        </div>--}}

                        <div class="form-group">
                            <label for="expired_at" class="col-sm-3 control-label"> مهلت استفاده (اجباری)</label>
                            <input id="expired_at" type="hidden" name="expired_at" class="form-control" data-mddatetimepicker="true" placeholder="مهلت استفاده را وارد کنید" data-placement="right" value="{{ old('expired_at' , $discount->expired_at) }}">
                            <input id="expired_at_show" type="text" name="expired_at_show" class="form-control" data-mddatetimepicker="true" placeholder="مهلت استفاده را وارد کنید" data-placement="right" value="{{ old('expired_at') }}">
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ویرایش کد تخفیف</button>
                        <a href="{{ route('admin.discount.index') }}" class="btn btn-default float-left">لغو</a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>



@endcomponent
