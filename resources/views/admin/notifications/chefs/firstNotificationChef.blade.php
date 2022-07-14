<p style="text-align: center">نعلمكم أنه تم تسجيل شكوى بداءرة إختصاصكم الإقليمي </p>
<p style="text-align: center">بتاريخ : <strong>{{ $plainte->created_at }}</strong></p>
<p style="text-align: center">و تحمل الرقم: <strong>{{ $plainte->id }}</strong></p>
<p style="text-align: center">المقدمة من طرف السيد :<strong>{{ $user->name }}</strong></p>
<p style="text-align: center">يرجى النقر على هذا الرابط للإطلاع على التفاصيل
<a href="{{url('/admin#/admin/cotation.plainte/'.$plainte->id)}}">التفاصيل</a> </p>

<p style="text-align: center">مع تحياتنا الخالصة</p>
@include('admin.notifications.footer')
