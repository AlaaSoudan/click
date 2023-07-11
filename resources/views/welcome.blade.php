<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>click</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Styles -->



</head>
<style>
    body {

        direction: rtl;
    }
</style>

<body>

    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-white">
        <!-- Container wrapper -->
        <div class="container">
            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                data-mdb-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent1">
                <!-- Navbar brand -->
               {{--  <a class="navbar-brand mt-2 mt-sm-0" href="https://mdbootstrap.com/">
                    <img src="https://mdbcdn.b-cdn.net/img/logo/mdb-transaprent-noshadows.webp" height="20"
                        alt="MDB Logo" loading="lazy" />
                </a> --}}
                <!-- Left links -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item ">
                        <a class="nav-link " href="/home">الرئيسية </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('My_orders') }}">طلبات</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">حول الشركة</a>
                    </li>

                </ul>
                <!-- Left links -->
            </div>
            <!-- Collapsible wrapper -->

            <!-- Right elements -->
            <div class="d-flex align-items-center">
                <!-- Icon -->
                @if (Route::has('login'))
                    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                        @auth

                        @else
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">تسجيل
                               دخول</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">إنشاء حساب</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
            <!-- Right elements -->

        </div>
        <!-- Container wrapper -->
    </nav>
    <main>  <section class="hero is-large is-info">
        <div class="hero-body">
          <p class="title">
            Large hero
          </p>
          <p class="subtitle">
            Large subtitle
          </p>
        </div>
      </section>>
        </main>
    <footer class="text-right text-white mt-4" style="background-color: #fff">


          <!--/.Call to action-->
        <hr class="text-dark">

        <div class="container">
          <!-- Section: Social media -->
          <section class="mb-1">



            <!-- ca -->

         <a
              class="btn-link btn-floating btn-md "
             href="#!"
              role="button"
              color="dark"
              > للتواصل:0666666666</a>


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
</body>

</html>
<style>
.carousel-item {
    height: 50vh;
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
color:#263238
}

.sale {
color: #E53935
}

.sale-badge {
background-color: #E53935
}
</style>
