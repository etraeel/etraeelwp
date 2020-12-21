<?php

use Illuminate\Database\Seeder;



class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('settings')->insert([
            'name' => 'site_logo',
            'value' => 'img/logo.png',
        ]);

        DB::table('settings')->insert([
            'name' => 'site_name',
            'value' => 'وب پکس',
        ]);

        DB::table('settings')->insert([
            'name' => 'site_phone_number',
            'value' => '+989135460060',
        ]);

        DB::table('settings')->insert([
            'name' => 'site_email',
            'value' => 'mhseif90@gmail.com',
        ]);

        DB::table('settings')->insert([
            'name' => 'site_contact_us',
            'value' => 'اصفهان - خ حکیم نظامی - پ 166 -- 09135460060',
        ]);

        DB::table('settings')->insert([
            'name' => 'site_about_us',
            'value' => 'توضیحات',
        ]);

        DB::table('settings')->insert([
            'name' => 'question',
            'value' => '<p dir="rtl">&nbsp;</p>

<p dir="rtl">1<span style="color:#085294"><span style="font-family:inherit">.چرا برای خرید از بازاراتو، می بایست در وبسایت عضویت داشته باشم؟</span></span></p>

<div dir="rtl">ثبت نام ( ایجاد <a href="https://www.bazarato.com/index.php?route=account/register" style="color:#ff0000" target="">حساب کاربری</a> ) در <a href="https://www.bazarato.com" target="">وبسایت بازاراتو</a> موجب ارایه خدمات مطلوب و سهولت درپیگیری سفارش ها می گردد. تیم پشتیبانی بازاراتو به تمامی مراحل خرید، از زمان ثبت سفارش تا تحویل آن به مشتری، نظارت مستقیم دارد. در صورت عدم تمایل می توانید پس از خرید اینترنتی، عضویت خود را لغو کنید.</div>

<p dir="rtl">&nbsp;</p>

<p dir="rtl">&nbsp;</p>

<div dir="rtl"><span style="color:#085294"><span style="font-family:inherit">2. روش ثبت سفارش کالا چگونه است؟</span></span></div>

<div dir="rtl">&nbsp;</div>

<div dir="rtl">برای خرید از سایت بازاراتو ابتدا پس از انتخاب کالای موردنظر، آنرا به سبد خرید اضافه و مراحل خرید اینترنتی را به ترتیب تکمیل نمایید. حتمادر زمان ثبت سفارش مربوطه، تعداد، نوع، رنگ، جنس، اندازه و مبلغ نهایی، نام کالای مربوطه را به دقت بررسی و اطمینان حاصل نمایید. پس از آن از طرف تیم پشتیبانی مشتریان بازاراتو بوسیله پیامک و یا سایر ابزارهای ارتباطی که در نظر گرفته شده، تاییدثبت سفارش نهایی اطلاع رسانی خواهد شد.</div>

<p dir="rtl">&nbsp;</p>

<h3 dir="rtl"><span style="color:#085294">3. برای سفارش کالا به کمک نیاز دارم. چگونه و با چه کسی تماس بگیرم؟ </span></h3>

<div dir="rtl">تیم پشتیبانی بازاراتو، در زمان ساعات اداری ( از ساعت 9 تا17:30) پاسخگوی شما می باشد. اگر در خارج از این زمان سؤال یا ابهامی برای شمابوجود آمد برای ما پیغام (اس ام اس) بگذارید تا در اولین ساعات روز کاری بعد باشما تماس حاصل گردد.(09038340126) جهت کسب اطلاعات بیشتر می توانید از قسمت <a href="https://www.bazarato.com/index.php?route=information/contact" target="">تماس با ما</a> اقدام کنید.</div>

<p dir="rtl">&nbsp;</p>

<p>&nbsp;</p>

<div dir="rtl"><span style="color:#085294"><span style="font-family:inherit">4. در چه ساعاتی از شبانه روز امکان ثبت سفارش وجود دارد؟</span></span></div>

<div dir="rtl">&nbsp;</div>

<div dir="rtl">در تمامی ساعات شبانه روز امکان ثبت سفارش وجود دارد. تیم کارشناسان بازاراتو در اسرع وقت و کوتاه ترین زمان ممکن برای پیگیریسفارش کالای شما اقدام می نمایند و تایید سفارش را برای شما پیامک می کنند.</div>

<p dir="rtl">&nbsp;</p>

<p dir="rtl">&nbsp;</p>

<div dir="rtl"><span style="color:#085294"><span style="font-family:inherit">5. آیا امکان لغو سفارش وجود دارد ؟</span></span></div>

<div dir="rtl">&nbsp;</div>

<div dir="rtl">بله، در هر زمان از ثبت سفارش امکان لغو سفارش برای شما وجود دارد. ولی پس از ثبت کالای مورد نظر خود و پرداخت وجه آن، می بایست با تیم پشتیبانی بازاراتو تماس بگیرید. (88321162-021) اگر سفارش شما بسته بندی و ارسال نشده باشد ظرف 24 ساعت کل وجه شما مسترد خواهد شد. چنانچه سفارش شما بسته بندی شده باشد اما ارسال نشده باشد هزینه بسته بندی از شما کسر و الباقی وجه طی 24 ساعت مسترد خواهد شد و اگر کالای شما ارسال شده باشد می توانید پس از تحویل کالا، <a href="https://www.bazarato.com/return-product" target="">روشهای بازگشت کالا</a> را در سایت مطالعه و بر اساس آن اقدام نمایید.</div>

<p dir="rtl">&nbsp;</p>

<h3 dir="rtl"><span style="color:#085294">6. آیا برای اطمینان از پردازش ثبت سفارش، لازم است که با بازاراتو تماس بگیرم </span></h3>

<div dir="rtl">&nbsp;</div>

<div dir="rtl">خیر، پس از تایید نهایی سفارش، پیامکی از طرف بازاراتو برای شما ارسال می گردد تا از آغاز روند خرید اینترنتی خود اطمینان حاصل کنید. در صورت لزوم، کارشناسان وب سایت بازاراتو با شما تماس خواهند گرفت.</div>

<p dir="rtl">&nbsp;</p>

<div dir="rtl">&nbsp;</div>

<div dir="rtl"><span style="color:#085294"><span style="font-family:inherit">7. زمان اعلام شده از طریق پیامک برای تحویل کالا برای من مناسب نیست. راهکار لازم چیست ؟</span></span></div>

<div dir="rtl">&nbsp;</div>

<div dir="rtl">کافیست از قسمت <a href="https://www.bazarato.com/index.php?route=information/contact" target="">تماس با ما</a> با واحد پشتیبانی بازاراتو تماس بگیرید.چنانچه این امکان وجود داشته باشد کارشناسان ما تمامی تلاش خود را برای برطرف کردن نیاز شما بکار خواهند گرفت.</div>

<p dir="rtl">&nbsp;</p>

<div dir="rtl">&nbsp;</div>

<div dir="rtl"><span style="color:#085294"><span style="font-family:inherit">8. آیا امکان خرید حضوری و یا تلفنی وجوددارد؟</span></span></div>

<div dir="rtl">&nbsp;</div>

<div dir="rtl">بله؛&nbsp; اما هدف بازاراتو این است که شما یک خرید آسان و لذتبخش آنلاین را تجربه کنید. اما چنانچه شما نیاز به خرید حضوری دارید کارشناسان ما پاسخ گوی شما خواهند بود.</div>

<p dir="rtl">&nbsp;</p>

<div dir="rtl"><span style="color:#085294"><span style="font-family:inherit">9.آیا امکان ارسال کالا و تسویه وجه آن در هنگام تحویل وجود دارد؟</span></span></div>

<div dir="rtl">&nbsp;</div>

<div dir="rtl"><span style="background-color:#ffffff"><span style="color:#ff0000"><strong>فقط در شهر تهران</strong></span></span>&nbsp;امکان پرداخت وجه هنگام تحویل کالا وجود دارد. این امکان فعلا برای سفارش های به مقصد شهرستان وجود ندارد.</div>

<p dir="rtl">&nbsp;</p>

<div dir="rtl">&nbsp;</div>

<div dir="rtl"><span style="color:#085294"><span style="font-family:inherit">10. آیا امکان ارسال کالا برای دیگران وجود دارد؟</span></span></div>

<div dir="rtl">&nbsp;</div>

<div dir="rtl">بله، چنانچه می خواهیدسفارش مربوطه به آدرس دیگری غیر از آدرس شما ارسال شود، با ثبت آدرس مورد نظرتان در هنگام ثبت سفارش و اعلام به سایت بازاراتو و هماهنگی زمان تحویل، کالای مربوطه به آدرس ذکرشده تحویل داده می شود. ( در هنگام ثبت سفارش به گزینه مربوط به <span style="color:#ff0000">ارسال به آدرس دیگر</span> برخورد خواهید کرد که شما می توانید آدرس دیگری را به غیر از آدرس خودتان در آن قسمت وارد نمایید. )</div>

<p dir="rtl">&nbsp;</p>

<div dir="rtl">&nbsp;</div>

<div dir="rtl"><span style="color:#085294"><span style="font-family:inherit">11. در صورت عدم حضور دریافت کننده در آدرس اعلام شده توسط مشتری، هماهنگی بعدی به چه صورت انجام می گیرید؟</span></span></div>

<div dir="rtl">&nbsp;</div>

<div dir="rtl">می بایست با تماس از طریق تلفن و یا ارسال پیامک، عدم حضورخود را اعلام کنید تا زمان بعدی مجددا هماهنگ شود. همچنین شما می توانید برای جلوگیری از برگشت کالا، زمان حضور خود را اعلام نمایید تا کالا در زمان مشخص برای شما ارسال شود.</div>

<p dir="rtl">&nbsp;</p>

<p dir="rtl">&nbsp;</p>

<h3 dir="rtl"><span style="color:#085294">12. اگر کالای ارسالی با کالایی که در وبسایت بازاراتو دیدم مغایرت داشت، باید چکار کنم؟</span></h3>

<div dir="rtl">&nbsp;</div>

<div dir="rtl">می توانید از طریق تماس تلفنی یا ارسال پیامک و یا بخش <a href="https://www.bazarato.com/index.php?route=information/contact" target="">تماس با ما</a> هر گونه مغایرت را به تیم پشتیبانی بازاراتو اطلاع دهید. بدیهی است بازاراتو خود را موظف به عودت کالا می داند و کارشناسان ما شما را جهت استردادکالا طبق <a href="https://www.bazarato.com/return-product" target="">دستورالعمل استرداد کالا</a> راهنمایی می کنند.</div>

<h3 dir="rtl">&nbsp;</h3>

<div dir="rtl">&nbsp;</div>

<div dir="rtl"><span style="color:#085294"><span style="font-family:inherit">13. جهت بازگشت کالا پس از تماس با بازاراتو و پر کردن فرم، بلافاصله امکان بازگشت کالا وجود دارد؟</span></span></div>

<div dir="rtl">&nbsp;</div>

<div dir="rtl">واحد پشتیبانی بازاراتو برای هماهنگی و زمانبندی بازگشت کالا و نحوه آن با شما تماس می گیرد. ( <a href="https://www.bazarato.com/return-product" target="">روش های بازگشت کالا</a> را مطالعه فرمایید )<br />
&nbsp;</div>

<div dir="rtl">&nbsp;</div>

<div dir="rtl"><span style="color:#085294"><span style="font-family:inherit">14. اگر پرداخت سفارشم مغایرت داشت به چه صورت اطلاع دهم؟</span></span></div>

<div dir="rtl">&nbsp;</div>

<div dir="rtl">اگر پرداخت به صورت آنلاین دچار اختلال شد و یا فاکتور پرداخت شده با مبلغ سفارش مغایرت داشت این موضوع را از طریق تماس تلفنی با تیم پشتیبانی بازاراتو پیگیری نمایید تا هر چه سریعتر برای آن، اقدامات کافی و لازم انجام گیرد.&nbsp;</div>

<div dir="rtl">&nbsp;</div>

<div dir="rtl">&nbsp;</div>',
        ]);

    }
}
