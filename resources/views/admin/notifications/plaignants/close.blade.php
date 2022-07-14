<p style="text-align:right"> <strong>{{ $user->name }}</strong>: (ة)سيد(ت)ي المحترم</p>
<p style="text-align:right"><strong>{{ $plainte->date_close }}</strong> نعلكم أنه تم غلق الشكوى المقدمه من طرفكم بتاريخ </p>
<p style="text-align:right">للسبب التالي </p>
<p style="text-align:right"> <strong>{{ $plainte->motif_close }}</strong></p>

<p style="text-align:center">مع تحياتنا الخالصة</p>
@include('admin.notifications.footer')
