<!doctype html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="assets/js/pages/crud/forms/widgets/bootstrap-select.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link href="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.css" rel="stylesheet">

    <script src="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.22.1/dist/extensions/mobile/bootstrap-table-mobile.min.js"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>click</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #fbfbfb;
            direction: rtl;
        }

        .carousel-item {
            height: 50vh;
        }

        main {
            min-height: 100vh;
        }

        .card {
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        }

        .footer-cta {
            box-shadow: rgba(0, 0, 0, 0.15) 0px 5px 15px;
        }

        .price {
            color: #263238;
            font-size: 24px;
        }

        .card-title {
            color: #263238
        }

        .sale {
            color: #E53935
        }

        .sale-badge {
            background-color: #E53935
        }
    </style>

</head>


<body dir="rtl">
    <div id="app">

        <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-white">
            <a class="navbar-brand" href="{{ route('home') }}">الرئسية</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('My_orders') }}">طلباتك السابقة</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('shopping_Cart') }}">
                            <i class="fas fa-shopping-cart">سلتي</i>
                            <span class="badge rounded-pill badge-notification bg-danger">1</span>
                        </a>
                    </li>
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link has-text-info" href="{{ route('login') }}">تسجيل دخول</a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li class="nav-item ">
                                <a class="nav-link has-text-info" href="{{ route('register') }}">إنشاء حساب</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item ">
                            <a class="nav-link has-text-info" href="#" role="button" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a class="nav-link has-text-info" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                                تسجيل الخروج
                            </a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        @endif



                    </ul>


                </div>
            </nav>



            <main class="  py-4 px-4">
                @yield('content')
            </main>
            <footer class="text-right text-white mt-4 py-1
         " style="background-color: #fff">


                <!--/.Call to action-->
                <hr class="text-dark">

                <div class="container">
                    <!-- Section: Social media -->
                    <section class="mb-1">



                        <!-- ca -->

                        <a class="btn-link btn-floating btn-md " href="#!" role="button" color="dark">
                            للتواصل:0666666666</a>


                    </section>
                    <!-- Section: Social media -->
                </div>
                <!-- Grid container -->

                <!-- Copyright -->
                <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2); text-color: #E0E0E0">
                    © 2023
                    <a class="text-white" href="https://mdbootstrap.com/">click.com</a>


                </div>
                <!-- Copyright -->
            </footer>
        </div>
    </body>

    </html>
