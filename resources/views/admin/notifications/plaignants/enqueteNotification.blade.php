<p style="text-align: right"> نعلم سيادتكم أنه تم التحقيق في الشكوى المقدمة من طرفكم  </p>
<p style="text-align: right"> و المتعلقة بـ  <strong>{{ $plainte->specialite->specialite }}</strong> </p>
<p style="text-align: right"> و المقدمة ضد <strong>{{ $plainte->defendeur }}</strong></p>
<p style="text-align: right">  و أسفرت النتائج إلى <strong>{{ $enquete->resultat->resultat }}</strong></p>
<p style="text-align: right">  و في ما يلي التقرير النهائي <strong>{{ $enquete->rapport }}</strong></p>


<p style="text-align: center">مع تحياتنا الخالصة</p>
@include('admin.notifications.footer')
