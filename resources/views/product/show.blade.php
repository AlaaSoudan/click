@extends('admin.adminpage')
@section('content_admin')
    <!--begin::Form-->
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom gutter-b example example-compact">
                <!--begin::Header-->
                <div class="card-header border-0 py-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">
                            <span class="fa fa-table">&nbsp;</span>
                            انشاء منتج جديد
                        </span>
                    </h3>
                    <!--begin::Actions-->
                    <div class="my-lg-0 my-1">
                        <a class="btn btn-sm btn-primary font-weight-bolder text-uppercase"
                            href="{{ route('add_product') }}">منتج جديد</a>
                    </div>
                    <!--end::Actions-->
                </div>
                <!--end::Header-->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Advance Table Widget 4-->
            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Header-->
                <div class="card-header border-0 py-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">
                            <span class="fa fa-table">&nbsp;</span> المنتجات
                        </span>
                    </h3>
                    <div>
                        <form action="{{ route('product') }}" method="GET">
                            <input style="DISPLAY: inline;
                        " value="{{ request('keyword') }}"
                                name="keyword" type="text" data-kt-ecommerce-order-filter="search"
                                class="form-control form-control-solid w-250px ps-14 mr-3" placeholder="Search Prouduct">
                            <button class="btn  btn-primary" type="submit">بحث</button>
                        </form>
                    </div>


                </div>

            </div>

            <form method="POST" action="{{ route('filterproduct') }}">
                @csrf
                <div class='columns'>
                    <div class='column'>

                        <div class="card w-500  my-3">
                            <h3 class="has-text-right">

                                تصنيفات
                            </h3>
                            <div class="columns is-multiline is-mobile">


                                @foreach ($categories as $category)
                                    <div class="column is-one-quarter">
                                        <input type="checkbox" name="category"
                                            value="{{ $category->id }}">{{ $category->name }}
                                    </div>
                                @endforeach

                            </div>

                        </div>
                    </div>
                    <div class='column'>
                        <div class="card card-custom w-100  my-3 gutter-b">
                            <h3 class="menu-label">
                                شركات
                            </h3>
                            <div class="columns is-multiline is-mobile">
                                @foreach ($companies as $company)
                                    <div class=' column is-one-quarter flex '>
                                        <input type="checkbox" name="company" value="{{ $company->id }}">
                                        {{ $company->name }}

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <button class="button bg-danger is-medium" type="submit"> بحث</button>


            </form>
            <div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            @if (!count($products) == 0)
                <div class=" pt-0 pb-3">
                    <div>
                        <!--begin::Table-->
                        <div class="table-responsive">
                            <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                                <thead>
                                    <tr class="text-uppercase">
                                        <th></th>
                                        <th>الاسم</th>
                                        <th>السعر</th>


                                        <th>مستوى </th>
                                        <th>التصنيف</th>

                                        <th>الشركة </th>
                                        <th>توافر المنتج</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($products as $key => $product)
                                        <tr data-toggle="collapse" data-target="#collapseExample{{ $key }}"
                                            role="button" aria-expanded="false" aria-controls="collapseExample">
                                            <td>
                                                <div class="symbol symbol-50 flex-shrink-0 mr-4">

                                                    <div class="symbol-label"
                                                        style="background-image: url('{{ url('storage/' . $product->imageUrl) }}')">
                                                    </div>

                                                </div>
                                            </td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->price }}</td>








                                            <td>
                                                @if ($product->parentProduct != null)
                                                    {{ $product->parentProduct->name }}
                                                @else
                                                    //Level 1
                                                @endif
                                            </td>
                                            <td>{{ $product->category->name }}</td>


                                            </td>
                                            <td>{{ $product->companies->name }}</td>


                                            </td>
                                            <td>
                                                <form method="POST"
                                                    action="{{ route('changeProductStatus', $product->id) }}"
                                                    method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <label>
                                                        @if ($product->productstatus == 0)
                                                            متوفر غير
                                                        @else
                                                            متوفر
                                                        @endif
                                                        <input hidden type="text" name="product_id" class="form-control"
                                                            value="{{ $product->id }}">
                                                        <input type="checkbox"value="{{ $product->productstatus }}"
                                                            @if ($product->productstatus) checked @endif name="status"
                                                            onchange="this.form.submit()"
                                                            {{ $product->status ? 'checked' : '' }}>
                                            </td>

                                            </label>
                                            </form>
                                            </td>

                                            <td>
                                            <td>

                                                <a class="btn btn-sm btn-clean btn-icon"
                                                    href="{{ route('edit_product', $product->id) }}">edit
                                                    <i class="icon-1x text-dark-50 flaticon-edit-1"></i>
                                                </a>
                                                <a class="btn btn-sm btn-clean btn-icon"
                                                    onclick="return confirm('Are you sure?')"
                                                    href="{{ route('delete_product', $product->id) }}"
                                                    class="btn btn-sm btn-clean btn-icon">del
                                                    <i class="icon-1x text-dark-50 flaticon-delete"></i>
                                                </a>

                                                <a data-toggle="collapse" data-target="#collapseExample{{ $key }}"
                                                    role="button" aria-expanded="false" aria-controls="collapseExample"
                                                    class="btn btn-sm btn-clean btn-icon">
                                                    <span class="svg-icon svg-icon-clean svg-icon-2x">
                                                        <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Dial-numbers.svg--><svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                            height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                                fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24"
                                                                    height="24" />
                                                                <rect fill="#000000" opacity="0.3" x="4"
                                                                    y="4" width="4" height="4"
                                                                    rx="2" />
                                                                <rect fill="#000000" x="4" y="10"
                                                                    width="4" height="4" rx="2" />
                                                                <rect fill="#000000" x="10" y="4"
                                                                    width="4" height="4" rx="2" />
                                                                <rect fill="#000000" x="10" y="10"
                                                                    width="4" height="4" rx="2" />
                                                                <rect fill="#000000" x="16" y="4"
                                                                    width="4" height="4" rx="2" />
                                                                <rect fill="#000000" x="16" y="10"
                                                                    width="4" height="4" rx="2" />
                                                                <rect fill="#000000" x="4" y="16"
                                                                    width="4" height="4" rx="2" />
                                                                <rect fill="#000000" x="10" y="16"
                                                                    width="4" height="4" rx="2" />
                                                                <rect fill="#000000" x="16" y="16"
                                                                    width="4" height="4" rx="2" />
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </a>
                                            </td>
                                        </tr>



                                        {{--     <tr class="accordian-body collapse"
                                                    id="collapseExample{{ $key }}">

                                                    @foreach ($product->childrenProducts as $child)
                                                <tr class="accordian-body collapse"
                                                    id="collapseExample{{ $key }}">

                                                    <td>
                                                        @if ($child->imageUrl != null)
                                                            <div class="symbol symbol-50 flex-shrink-0 mr-4">

                                                                <div class="symbol-label"
                                                                    style="background-image: url('{{ url('storage/' . $child->imageUrl) }}')">
                                                                </div>

                                                            </div>
                                                        @else
                                                            <div class="symbol symbol-45px me-5">
                                                                <span
                                                                    class="symbol-label fs-2x fw-bold text-primary bg-light-primary"
                                                                    style="text-transform: uppercase">Ch</span>
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td>{{ $child->name }}</td>
                                                    <td>{{ $child->price }}</td>
                                                    <td>
                                                        @if ($child->parentProduct != null)
                                                            {{ $child->parentProduct->name }}
                                                        @else
                                                            //Level 1
                                                        @endif
                                                    </td>
                                                    <td>{{ $child->category->name }}</td>

                                                    <td>
                                                        @if ($child->smell != null)
                                                            {{ $child->smell->name }}
                                                        @else
                                                            _____
                                                        @endif
                                                    </td>
                                                    <td>

                                                        @if ($child->size != null)
                                                            {{ $child->size->name }}
                                                        @else
                                                            _____
                                                        @endif


                                                    </td>
                                                    <td>

                                                        <a class="btn btn-sm btn-clean btn-icon"
                                                            href="{{ route('edit_product', $child->id) }}">edit
                                                            <i class="icon-1x text-dark-50 flaticon-edit-1"></i>
                                                            </(a>
                                                            <a class="btn btn-sm btn-clean btn-icon"
                                                                onclick="return confirm('Are you sure?')"
                                                                href="{{ route('delete_product', $child->id) }}"
                                                                class="btn btn-sm btn-clean btn-icon">
                                                                <i class="icon-1x text-dark-50 flaticon-delete">del</i>
                                                            </a>
                                                    </td>
                                                </tr> --}}
                                    @endforeach
                                </tbody>
                            </table>
                            {{--  --}}
                        </div>
                        {{ $products->links() }}

                    </div>
                    <!--end::Table-->
                </div>

                <!--end::Body-->
     </div>
    @else
        <p style="text-align: center"> No Records Found</p>
        @endif
        <!--end::Advance Table Widget 4-->

@endsection
