@component('admin.layouts.content',['title' => 'داشبورد'])
    @slot('breadcrumb')
        <li class="breadcrumb-item active">داشبورد</li>

    @endslot

    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{\App\Order::where('status' , 'paid')->count()}}</h3>
                    <p>سفارشات جدید</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="/admin/orders?type=paid" class="small-box-footer">اطلاعات بیشتر <i
                        class="fa fa-arrow-circle-left"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3 class="translate"> {{number_format($ghasedakCredit)}} ریال </h3>
                    <p>اعتبار پیامک</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a target="_blank" href="https://ghasedaksms.com" class="small-box-footer">اطلاعات بیشتر <i
                        class="fa fa-arrow-circle-left"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3 class="translate">{{\App\User::all()->count()}}</h3>
                    <p>تعداد کل کاربران</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{route('admin.users.index')}}" class="small-box-footer">اطلاعات بیشتر <i
                        class="fa fa-arrow-circle-left"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{\App\UserMessage::where('status', 3)->count()}}</h3>
                    <p>پیام های خوانده نشده</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{route('admin.receivedMessages')}}" class="small-box-footer">اطلاعات بیشتر <i
                        class="fa fa-arrow-circle-left"></i></a>
            </div>
        </div>
        <!-- ./col -->

        <div class="card col-12">
            <div class="card-header no-border">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">میزان فروش</h3>
                </div>
            </div>
            <div class="card-body">

                <div id="sell_chart" class="col-12" style="height: 250px;"></div>
                <div class="d-flex flex-row justify-content-end">
                  <span class="ml-2"><i class="fa fa-square text-primary"></i>این هفته</span>
                  <span><i class="fa fa-square text-gray"></i>هفته گذشته</span>
                </div>
            </div>
        </div>
    </div>

@section('script')
    <script>
        new Morris.Line({
            // ID of the element in which to draw the chart.
            element: 'sell_chart',
            // Chart data records -- each entry in this array corresponds to a point on
            // the chart.
            data: [
                {year: '2008', lvalue:30 ,value: 20},
                {year: '2009', lvalue:25 ,value: 10},
                {year: '2010', lvalue:10 ,value: 5},
                {year: '2011', lvalue:45 ,value: 5},
                {year: '2012', lvalue:5 ,value: 20}
            ],
            // The name of the data record attribute that contains x-values.
            xkey: 'year',
            // A list of names of data record attributes that contain y-values.
            ykeys: ['value' , 'lvalue'],
            // Labels for the ykeys -- will be displayed when you hover over the
            // chart.
            labels: ['این هفته', 'هفته قبل'],
            barColors:['#000' , '#e90000'],
        });
    </script>
@endsection

@endcomponent
