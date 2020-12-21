@component('profile.layouts.content')

    @slot('profileTitle')
        <span>ارسال پیام</span>
    @endslot

    <div class="edit_items">
        <form action="{{route('profile.sendMessageToAdmin')}}" method="post">
            @csrf

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div >{{$error}}</div>
                @endforeach
            @endif
            <div class="edit_item">
                <label class="edit_item_title">عنوان پیام : </label>
                <input name="title" class="edit_item_value" type="text">
            </div>

            <div class="edit_item">
                <label class="edit_item_title">متن پیام: </label>
                <textarea style="background-color: #fff ; min-height: 200px ; border: 1px solid rgba(0,0,0,0.1)"
                          class="inp" name="text"></textarea>
            </div>

            <input class="btnn" type="submit" value="ارسال پیام">
        </form>

    </div>

@section('script')
    <script>

    </script>
@endsection

@endcomponent


