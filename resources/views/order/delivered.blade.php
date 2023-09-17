@extends('admin.adminpage')
@section('content_admin')
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Advance Table Widget 4-->
            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Header-->
                <div class="card-header border-0 py-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">

                            <span class="fa fa-table">&nbsp;</span> الطلبات المسلمة


                        </span>
                    </h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                @if (!count($orders) == 0)
                <div class="card-body pt-0 pb-3">
                    <div class="tab-content">
                        <!--begin::Table-->
                        <div class="table-responsive">
                            <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                                <thead>
                                    <tr class="text-uppercase">
                                            <th>السعر</th>

                                            <th>الحالة</th>
                                            <th></th>
                                            <th></th>
                                            <th>المستخدم</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>


                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($orders as $order)

                                            <tr>

                                                <td>{{ $order->total_price }}</td>
                                                <td>{{ $order->status }}</td>
                                                <td>{{ $order->created_date }}</td>
                                                <td>{{ $order->updated_date }}</td>
                                                <td>{{ $order->user->name }}</td>




                                                <td>{{ date('Y-m-d  H:i A', strtotime($order->created_at)) }}</td>
                                                <td>{{ date('Y-m-d  H:i A', strtotime($order->deliveryDate)) }}</td>
                                                   <td> <a class="btn btn-sm btn-clean btn-icon"
                                                            href="{{ route('order_details', $order->id) }}">
                                                           تفاصيل الطلب
                                                            <i class="icon-1x text-dark-50 flaticon-edit-1"></i>
                                                        </a>
                                                    </td>

                                                </tr>
                                        @endforeach

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
@endsection

@section('styles')

    <style>
        a.disabled {
            pointer-events: none;
            color: #ccc;
        }

    </style>
@endsection

@section('scripts')

{{--
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
    <script src="assets/js/pages/crud/forms/widgets/bootstrap-select.js"></script> --}}
@endsection
