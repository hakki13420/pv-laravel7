<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>المحاضر الرسمية</title>

        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- css -->
        <link href="{{asset('css/frontStyles.css')}}" rel="stylesheet" />

    </head>
    <body id="page-top">
        {{-- <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div> --}}

         <!-- Navigation-->

         <a class="menu-toggle rounded" href="#"><i class="fas fa-bars"></i></a>
         <nav id="sidebar-wrapper">
             <ul class="sidebar-nav">
                 <li class="sidebar-brand"><a href="#page-top">القائمة</a></li>
                 <li class="sidebar-nav-item"><a href="#page-top">الرئيسية</a></li>
                 <li class="sidebar-nav-item"><a href="#portfolio">مشاريع</a></li>
                 <li class="sidebar-nav-item"><a href="#contact">للاتصال</a></li>
             </ul>
         </nav>
         <!-- Header-->
        <header class="masthead d-flex align-items-center">
            <div class="container px-4 px-lg-5 text-center text-white">
                <h3 class="mb-1">الجمهورية الجزائرية الدموقراطية الشعبية</h3>
                <h3 class="mb-1">وزارة التجارة</h3>
                <h3 class="mb-5"><em>مديرية التجارة لولاية تلمسان</em></h3>

                <h1 class="mb-5">المحضر الرقمي</h1>
                <br>
                @auth
                    <a class="btn btn-outline-secondary btn-xl text-white" href="{{ url('/home') }}">الموقع</a>
                @else
                    <a class="btn btn-outline-secondary btn-xl text-white" href="{{ route('login') }}">الولوج</a>

                @endauth

            </div>

        </header>


        <!-- Portfolio-->
        <section class="content-section" id="portfolio">
            <div class="container px-4 px-lg-5">
                <div class="content-section-heading text-center">
                    <h3 class="text-secondary mb-0">خدمتكم هي غايتنا</h3>
                    <h2 class="mb-5">مشاريعنا المستقبلية</h2>
                </div>
                <div class="row gx-0">
                    <div class="col-lg-6">
                        <a class="portfolio-item" href="#!">
                            <div class="caption">
                                <div class="caption-content text-center">
                                    <div class="h4">إعادة فتح المحلات المغلقة</div>
                                    <p class="mb-0">منصة أليكترونية لمتابعة طلبات إعادة الفتح و كذلك لرفع اليد عن المحلات المغلقة</p>
                                </div>
                            </div>
                            <img class="img-fluid" src="./images/portfolio-1.jpg" alt="..." />
                        </a>
                    </div>
                    <div class="col-lg-6">
                        <a class="portfolio-item" href="#!">
                            <div class="caption">
                                <div class="caption-content text-center">
                                    <div class="h4">الصفقات العمومية</div>
                                    <p class="mb-0">منصة اليكترونية لمتابعة و معاينة الصفقات العمومية لقطاعنا</p>
                                </div>
                            </div>
                            <img class="img-fluid" src="./images/portfolio-2.jpg" alt="..." />
                        </a>
                    </div>
                    <div class="col-lg-6">
                        <a class="portfolio-item" href="#!">
                            <div class="caption">
                                <div class="caption-content text-center">
                                    <div class="h4">المنازعات</div>
                                    <p class="mb-0">أوامر بالدفع - محاضر رسمية- الغلق الاداري</p>
                                </div>
                            </div>
                            <img class="img-fluid" src="./images/portfolio-3.jpg" alt="..." />
                        </a>
                    </div>
                    <div class="col-lg-6">
                        <a class="portfolio-item" href="#!">
                            <div class="caption text-center">
                                <div class="caption-content">
                                    <div class="h4">التجارة الخارجية</div>
                                    <p class="mb-0">الاستراد و التصدير - شهادات الاحترام</p>
                                </div>
                            </div>
                            <img class="img-fluid" src="./images/portfolio-4.jpg" alt="..." />
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action-->
        <section class="content-section bg-primary text-white">
            <div class="container px-4 px-lg-5 text-center">
                <h3 class="mb-4">مديرية التجارة لولاية تلمسان</h3>
                <hr>
                <h5 class="mb-2">حي النسيم 09 إمامة تلمسان</h5>
                <h5 class="mb-2">الهاتف :043 21 08 76  -  043 21 08 76  - الفاكس : 043 21 08 79</h5>
                <h6 class="mb-2">dcptlemcen@gmail.com - www.dcptlemcen.dz</h6>

            </div>
        </section>
        <!-- Map-->
        <div class="map" id="contact">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3272.7385494247624!2d-1.34018718559857!3d34.887911080386786!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd78c8455275e7bf%3A0xdcadb2b093a2d9cf!2sDirection%20Du%20Commerce%20Tlemcen!5e0!3m2!1sfr!2sdz!4v1624314308820!5m2!1sfr!2sdz" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <!-- Footer-->
        <footer class="footer text-center">
            <div class="container px-4 px-lg-5">
                <ul class="list-inline mb-5">
                    <li class="list-inline-item">
                        <a class="social-link rounded-circle text-white mr-3" href="http://www.facebook.com/rabah.hakki"><i class="fab fa-facebook-f"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a class="social-link rounded-circle text-white mr-3" href="#!"><i class="fab fa-twitter"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a class="social-link rounded-circle text-white" href="http://www.facebook.com/rabah.hakki"><i class="fas fa-feather-alt"></i></a>
                    </li>
                </ul>
                <p class="text-muted small mb-0">جميع الحقوق محفوظة &copy; مديرية التجارة لولاية تلمسان@php
                    echo date('Y')
                @endphp </p>
            </div>
        </footer>

        <!-- javascript-->
        <script src="{{asset('js/frontScripts.js')}} "></script>
    </body>
</html>
