@component('admin.layouts.content',['title' => 'مدیریت بنر ها'])
    @slot('breadcrumb')

        <li class="breadcrumb-item"><a href="{{route('admin.admin')}}">داشبورد</a></li>
        <li class="breadcrumb-item active">مدیریت بنر ها</li>
    @endslot


    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">مدیریت بنر ها</h3>

            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0 ">

                <h5 class="mt-5 mb-5 d-flex justify-content-center">ترتیب عکس ها را با جابجا کردن درست کنید</h5>

                   <div id="list" class="d-flex flex-column align-items-center justify-content-center">

                   </div>

            </div>

        </div>
        <!-- /.card -->
    </div>

@section('script')
    <script>


        let list_items = {!! $banners!!}
          new draggable({
            el : document.querySelector('#list'),
            list : list_items,
            template : (item) => {
                return `
                            <div class="row img_box list-item" id="${item.id}">
                                  <img class="rounded" style="width: 250px; height: 100px" src="${item.url}" alt="">
                            </div>
        `
            },
            update : (list) => {
                // console.log('new List',list)
                axios.post('sortBannersUpdate' , list)
                .then(response => {console.log(response.data)})
                .catch(error =>{console.log(error)})
            }
        })
    </script>
@endsection

@endcomponent


