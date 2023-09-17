@extends('admin.adminpage')
@section('content_admin')
    <!--begin::Form-->
    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('SearchOrder') }}" method="POST" class="ml-5">
                @csrf
                <div class="input-group " style="max-width:300px text-align: center">
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

            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Header-->
                <div class="card-header border-0 py-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">

                            <span class="fa fa-table">&nbsp;</span> كل الطلبات


                        </span>
                    </h3>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <!--begin::Advance Table Widget 4-->

                        @if (!count($orders) == 0)
                            <div class="card-body pt-0 pb-3">
                                <div class="tab-content">
                                    <!--begin::Table-->
                                    <div class="table-responsive">
                                        {{--      <a class="btn btn-sm btn-clean btn-icon"
                                        href="{{ route('orders') }}">
                                      <h1>  كل الطلبات</h1>

                                    </a> --}}
                                        <table
                                            class="table table-head-custom table-head-bg table-borderless table-vertical-center">

                                            <thead>
                                                <tr class="text-uppercase">

                                                    <th>السعر</th>

                                                    <th></th>
                                                    <th></th>

                                                    <th>المستخدم</th>
                                                    <th></th>

                                                    <th>تغيير الحالة</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($orders as $order)
                                                    <tr>
                                                        <td>{{ $order->total_price }}</td>
                                                        {{--   <td>{{ app\models\Order::STATUS_ARABIC[$order->status] }}</td> --}}
                                                        <td>{{ $order->created_date }}</td>
                                                        <td>{{ $order->updated_date }}</td>
                                                        <td>{{ $order->user->name }}</td>



                                                        <td> <a class="btn btn-sm btn-clean btn-icon"
                                                                href="{{ route('order_details', $order->id) }}">
                                                                تفاصيل الطلب
                                                                <i class="icon-1x text-dark-50 flaticon-edit-1"></i>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <form action="{{ route('OrderStatus') }}" method="POST">
                                                                @csrf
                                                                <input hidden value="{{ $order->id }}" name="id"
                                                                    type="text">
                                                                @if ($order->status == app\models\Order::Order_Confirmed)
                                                                    <select class="form-control formStatus" id="status"
                                                                        name="status" onchange="statusFunction()">

                                                                        <option
                                                                            @if (app\models\Order::STATUS[$order->status] == 'Confirmed') selected @endif
                                                                            value="1" class="kt--bg-success ">جاري
                                                                            التحضير
                                                                        </option>
                                                                        <option
                                                                            @if (app\models\Order::STATUS[$order->status] == 'Delivered') selected @endif
                                                                            value="2" class="kt--bg-success ">تم تسليم
                                                                            الطلب
                                                                        </option>
                                                                        <option
                                                                            @if (app\models\Order::STATUS[$order->status] == 'Canceled') selected @endif
                                                                            value="3" class="kt--bg-success ">تم الغاء
                                                                            الطلب </option>
                                                                    </select>
                                                                @else
                                                                    <select class="form-control formStatus" id="status"
                                                                        name="status" onchange="statusFunction()">
                                                                        <option
                                                                            @if (app\models\Order::STATUS[$order->status] == 'Pending') selected @endif
                                                                            value="0" class="kt--bg-warning ">بانتظار
                                                                            قبول الطلب
                                                                        </option>
                                                                        <option
                                                                            @if (app\models\Order::STATUS[$order->status] == 'Confirmed') selected @endif
                                                                            value="1" class="kt--bg-success ">جاري
                                                                            التحضير
                                                                        </option>

                                                                        <option
                                                                            @if (app\models\Order::STATUS[$order->status] == 'Canceled') selected @endif
                                                                            value="3" class="kt--bg-success ">تم الغاء
                                                                            الطلب</option>
                                                                    </select>
                                                                @endif

                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            </tbody>
                                        </table>
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


            <script src="assets/js/pages/crud/forms/widgets/bootstrap-select.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

            <script>
                function statusFunction(e) {
                    e.form.submit();
                }
                $(document).on('change', '.formStatus', function() {
                    $status = confirm('Are you sure?');
                    if ($status) {
                        var e = this;
                        statusFunction(e);
                    } else {
                        location.reload();
                    }
                })
            </script>



        @endsection
