@extends('layouts.app')
@section('content')
    {{-- Aside --}}

    <!--Main Navigation-->

        <div class="container-fluid">


            <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
                <div class="position-sticky">
                    <div class="list-group list-group-flush mx-3 mt-4">
                        <a href="{{ route('admin') }}" class="list-group-item list-group-item-action py-2 ripple"
                            aria-current="true">

                            <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Main dashboard</span>
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon">wsedrtfyuio</span>
                        </button>
                        <a href="{{ route('home') }}" class="list-group-item list-group-item-action py-2 ripple"><i
                                class="fas fa-chart-line fa-fw me-3"></i><span>الرئيسية</span></a>
                        <div class="dropdown list-group-item list-group-item-action py-2 ripple">
                            <a class="dropbtn fas fa-chart-pie fa-fw me-3">الشركات</a>
                            <div class="dropdown-content fas fa-chart-pie fa-fw me-3">
                                <a href="{{ route('company') }}">عرض الشركات</a>
                                <a href="{{ route('add_company') }}">إضافة شركة</a>

                            </div>
                        </div>
                        <div class="dropdown list-group-item list-group-item-action py-2 ripple">
                            <a class="dropbtn fas fa-chart-pie fa-fw me-3">التصنفات</a>
                            <div class="dropdown-content fas fa-chart-pie fa-fw me-3">
                                <a href="{{ route('category') }}">عرض التصنيفات</a>
                                <a href="{{ route('add_category') }}">أنشاء تصنيف</a>

                            </div>
                        </div>
                        <div class="dropdown list-group-item list-group-item-action py-2 ripple">
                            <a class="dropbtn fas fa-chart-pie fa-fw me-3">المنتجات</a>
                            <div class="dropdown-content fas fa-chart-pie fa-fw me-3">
                                <a href="{{ route('product') }}">عرض المنتجات</a>
                                <a href="{{ route('add_product') }}">إنشاء منتج</a>

                            </div>
                        </div>
                        <div class="dropdown list-group-item list-group-item-action py-2 ripple">
                            <a class="dropbtn fas fa-chart-pie fa-fw me-3">الطلبات</a>
                            <div class="dropdown-content fas fa-chart-pie fa-fw me-3">
                                <a href="{{ route('orders') }}">كل الطلبات</a>
                                <a href="{{ route('deliveredOrders') }}"> الطلبات المسلمة</a>

                            </div>
                        </div>
                        <div class="dropdown list-group-item list-group-item-action py-2 ripple">
                            <a class="dropbtn fas fa-chart-pie fa-fw me-3">المستخدمون</a>
                            <div class="dropdown-content fas fa-chart-pie fa-fw me-3">
                                <a href="{{ route('showusers') }}">عرض المستخدمون</a>


                            </div>
                        </div>

                    </div>
                </div>
            </nav>
            <!-- Sidebar -->



    <!--Main Navigation-->

    <!--Main layout-->
    <main style="margin-top: 58px;">
        <div class="container ">

            @yield('content_admin')


        </div>
    </main>
    <style>
        body {
            background-color: #fbfbfb;
        }

        @media (min-width: 991.98px) {
            main {
                padding-left: 240px;
            }
        }

        html,
        body,
        #app {
            height: 100%;
        }

        #app {
            min-height: 100%;
            //display: flex;
            //flex-direction: column;
        }

        .main-content {
            //flex: 1;
        }

        .footer {
            margin-top: -12px;
        }

        @media screen and (max-width: 768px) {
            #menu-toggle:checked+.nav-menu {
                display: block;
            }
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            padding: 58px 0 0;
            /* Height of navbar */
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
            width: 240px;
            z-index: 600;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                width: 100%;
            }
        }

        .sidebar .active {
            border-radius: 5px;
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
        }

        .sidebar-sticky {
            position: relative;
            top: 0;
            height: calc(100vh - 48px);
            padding-top: 0.5rem;
            overflow-x: hidden;
            overflow-y: auto;
            /* Scrollable contents if viewport is shorter than content. */
        }

        .dropbtn {

            color: white;

            border: none;
            cursor: pointer;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: #3e698e;
        }
    </style>
    <!--Main layout-->
@endsection
