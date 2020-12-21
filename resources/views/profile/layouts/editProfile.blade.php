@component('profile.layouts.content')

    @slot('profileTitle')
        <span>ویرایش پروفایل</span>
    @endslot

   <div class="edit_items">
       <form action="{{route('profile.editUser')}}" method="post" enctype="multipart/form-data">
           @csrf
       <div class="avatar-upload">
           <div class="avatar-edit">
               <input name="logo_img" type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
               <label for="imageUpload"></label>
           </div>
           <div class="avatar-preview">
               <div id="imagePreview" style="background-image: url({{$user->pic_logo != null ? asset($user->pic_logo)  : asset('img/avatar.png')}})">
               </div>
           </div>
       </div>

       <div class="edit_item">
           <label class="edit_item_title">نام و نام خانوادگی : </label>
           <input name="name" class="edit_item_value" type="text" value="{{$user->name}}">
       </div>

       <div class="edit_item">
           <label class="edit_item_title">شماره موبایل: </label>
           <input name="mobile" class="edit_item_value" type="text" value="{{$user->mobile}}">
       </div>

       <div class="edit_item">
           <label class="edit_item_title">ایمیل : </label>
           <input disabled name="email" class="edit_item_value" type="text" value="{{$user->email}}">
       </div>

           <input class="btnn" type="submit" value="ذخیره تغییرات">
       </form>


   </div>

@section('script')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").change(function() {
            readURL(this);

        });
    </script>
@endsection

@endcomponent


