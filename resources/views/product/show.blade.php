
    <!--begin::Form-->
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom gutter-b example example-compact">
                <!--begin::Header-->
                <div class="card-header border-0 py-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">
                            <span class="fa fa-table">&nbsp;</span>
                            New Product
                        </span>
                    </h3>
                    <!--begin::Actions-->
                    <div class="my-lg-0 my-1">
                        <a class="btn btn-sm btn-primary font-weight-bolder text-uppercase"
                            href="{{ route('add_product') }}">New Product</a>
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
                                <span class="fa fa-table">&nbsp;</span> All Products
                            </span>
                        </h3>
                        <div>
                              <form action="{{route('product')}}" method="GET">
                            <input style="DISPLAY: inline;
                        " value="{{request("keyword")}}" name="keyword" type="text"
                            data-kt-ecommerce-order-filter="search"
                            class="form-control form-control-solid w-250px ps-14 mr-3" placeholder="Search Prouduct">
                            <button class="btn  btn-primary" type="submit">Search</button>
                        </form>
                        </div>

                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    @if (!count($products) == 0)
                        <div class="card-body pt-0 pb-3">
                            <div class="tab-content">
                                <!--begin::Table-->
                                <div class="table-responsive">
                                    <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                                        <thead>
                                            <tr class="text-uppercase">
                                                <th>Image</th>
                                                <th>Title</th>
                                                <th>Price</th>


                                                <th>Parent Product</th>
                                                <th>Category</th>

                                                <th>Action</th>
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

                                                    <td>
                                                        @if ($product->smell != null)
                                                            {{ $product->smell->name }}
                                                        @else
                                                        _____
                                                        @endif
                                                    </td>
                                                    <td>

                                                        @if ($product->size != null)
                                                            {{ $product->size->name }}
                                                        @else
                                                            _____
                                                        @endif


                                                    </td>
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

                                                        <a data-toggle="collapse"
                                                            data-target="#collapseExample{{ $key }}" role="button"
                                                            aria-expanded="false" aria-controls="collapseExample"
                                                            class="btn btn-sm btn-clean btn-icon">
                                                            <span class="svg-icon svg-icon-clean svg-icon-2x">
                                                                <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Dial-numbers.svg--><svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                                    <g stroke="none" stroke-width="1" fill="none"
                                                                        fill-rule="evenodd">
                                                                        <rect x="0" y="0" width="24" height="24" />
                                                                        <rect fill="#000000" opacity="0.3" x="4" y="4" width="4"
                                                                            height="4" rx="2" />
                                                                        <rect fill="#000000" x="4" y="10" width="4" height="4"
                                                                            rx="2" />
                                                                        <rect fill="#000000" x="10" y="4" width="4" height="4"
                                                                            rx="2" />
                                                                        <rect fill="#000000" x="10" y="10" width="4" height="4"
                                                                            rx="2" />
                                                                        <rect fill="#000000" x="16" y="4" width="4" height="4"
                                                                            rx="2" />
                                                                        <rect fill="#000000" x="16" y="10" width="4" height="4"
                                                                            rx="2" />
                                                                        <rect fill="#000000" x="4" y="16" width="4" height="4"
                                                                            rx="2" />
                                                                        <rect fill="#000000" x="10" y="16" width="4" height="4"
                                                                            rx="2" />
                                                                        <rect fill="#000000" x="16" y="16" width="4" height="4"
                                                                            rx="2" />
                                                                    </g>
                                                                </svg>
                                                                <!--end::Svg Icon-->
                                                            </span>
                                                        </a>
                                                    </td>
                                                </tr>



                                                <tr class="accordian-body collapse" id="collapseExample{{ $key }}">

                                                    @foreach ($product->childrenProducts as $child)
                                                <tr class="accordian-body collapse" id="collapseExample{{ $key }}">

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
                                                        </a>
                                                        <a class="btn btn-sm btn-clean btn-icon"
                                                            onclick="return confirm('Are you sure?')"
                                                            href="{{ route('delete_product', $child->id) }}"
                                                            class="btn btn-sm btn-clean btn-icon">
                                                            <i class="icon-1x text-dark-50 flaticon-delete">del</i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach


                                            </tr>
                    @endforeach

                    </tbody>

                    </table>
                    {{-- {!! $products->links() !!} --}}

                </div>
                <!--end::Table-->
            </div>

            <!--end::Body-->
        </div>
    @else
        <p style="text-align: center"> No Records Found</p>
        @endif
        <!--end::Advance Table Widget 4-->
        </div>
        </div>
        </div>
