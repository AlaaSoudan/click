@extends('layouts.App')
@section('content')


<section class="=container my-5">
    <nav class=" container navbar" >
    <!-- Container wrapper -->
    <div class="container-fluid " style="text-align: center">




        <!-- Search -->
        <form action="{{ route('Search') }}" method="POST" class="ml-5"
        >
            @csrf
            <div class="input-group "  style="max-width:300px text-align: center">
                <input name="keyword" value="{{ request('keyword') }}" type="text" class="form-control"
                    id="kt_subheader_search_form" placeholder="بحث...">
                <div class="input-group-append">
                    <button class="input-group-text">
                        <span class="svg-icon">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <path
                                        d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z"
                                        fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                    <path
                                        d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z"
                                        fill="#000000" fill-rule="nonzero"></path>
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <!--<i class="flaticon2-search-1 icon-sm"></i>-->
                    </button>
                </div>
            </div>
        </form>


    </div>
    <!-- Container wrapper -->
  </nav>

        <div class=" container my-5 has-text-right columns is-fullheight">



    <aside class=" menu column is-2 is-narrow-mobile is-fullheight section ">
        <form method="POST" action="{{ route('filter') }}">
            @csrf
                <h1 class="menu-label">

                    تصنيفات
                </h1>
                <ul class="menu-list">
                    @foreach ($categories as $category)
                        <li>


                                <input type="checkbox" name="category" value="{{ $category->id }}">{{ $category->name }}


                        </li>
                    @endforeach
                </ul>
                <h1 class="menu-label">
                    شركات
                </h1>
                <ul class="menu-list">
                    @foreach ($companies as $company)
                        <li>


                                <input type="checkbox" name="company" value="{{ $company->id }}"> {{ $company->name }}



                        </li>
                    @endforeach
                </ul>
                <button class="btn" type="submit"> dsss</button>
            </form>
            </aside>




            @if (!count($product) == 0)
            <div class="mb-4">
                <h3 class="has-text-right">المنتجات</h3>

                <br>
            </div>
                <div class="row">

                    @foreach ($product as $products)
                        <div class="col-lg-3 col-md-4 col-sm-4 d-flex">
                            <div class="card w-120  my-3 shadow-2-strong">
                                <img src="{{ url('storage/' . $products->image) }}" class="  card-img-top"
                                    style="aspect-ratio: 1 / 1" />
                                <div class="hover-overlay">
                                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $products->name }}</h5>
                                    <p class="card-text">{{ $products->description }}</p>
                                    <p class="mb-2 price">{{ $products->price }} ل.س</p>
                                    <div class=" d-flex align-items-end pt-1 px-0 pb-0 mt-auto">
                                        <form action="{{ route('add_to_cart', $products->id) }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            <label for="quantity">الكمية</label>
                                            <input type="number" class="input" id="quantity" name="quantity"
                                                min="1" max="100">

                                            <button type="submit" class="btn btn-primary shadow-0 me-1"><i
                                                    class="fa fa-plus"></i>إضافة</button>
                                        </form>

                                    </div>
                                </div>

                            </div>

                        </div>
                    @endforeach
                    <div class="d-flex justify-content-center  ">
                         {{ $product->links() }}
                                     </div>

                    <section>


                </div>

            @else
                <p style="text-align: center;    margin: revert;"> لا يوجد منتجات</p>
            @endif

    </section>
    <!-- Products -->


    <style>
        .icon-hover:hover {
            border-color: #3b71ca !important;
            background-color: white !important;
        }

        .icon-hover:hover i {
            color: #3b71ca !important;
        }
        .card-img-top{
            max-height: 200px
        }
        .card-text{
            max-height: 120px
        }
      /*   .card {
            max-height: 440px
        } */</style>
@endsection
