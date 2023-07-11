<!--begin::Form-->
<div class="row">
    <div class="col-lg-12">
        <div class="card card-custom gutter-b example example-compact ">
            <!--begin::Header-->
            <div class="card-header border-0 py-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label font-weight-bolder text-dark">
                        <span class="fa fa-table">&nbsp;</span>
                        all orders
                    </span>
                </h3>


                <div class="row">
                    <div class="col-lg-12">
                        <!--begin::Advance Table Widget 4-->

                        @if (!count($orders) == 0)
                            <div class="card-body pt-0 pb-3">
                                <div class="tab-content">
                                    <!--begin::Table-->
                                    <div class="table-responsive">
                                        <table
                                            class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                                            <thead>
                                                <tr class="text-uppercase">

                                                    <th>price</th>
                                                    <th>status</th>
                                                    <th>users</th>
                                                    <th>change status</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($orders as $order)
                                                    <td>{{ $order->total_price }}</td>
                                                    <td>{{ $order->status }}</td>
                                                    <td>{{ $order->created_date }}</td>
                                                    <td>{{ $order->updated_date }}</td>
                                                    <td>{{ $order->user->name }}</td>



                                                    <td> <a class="btn btn-sm btn-clean btn-icon"
                                                            href="{{ route('order_details', $order->id) }}">
                                                            show order details
                                                            <i class="icon-1x text-dark-50 flaticon-edit-1"></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('OrderStatus') }}" method="POST" id="ww">
                                                            @csrf
                                                            <input hidden value="{{ $order->id }}" name="id"
                                                                type="text">
                                                            @if ($order->status == app\models\Order::Order_Confirmed)
                                                              <select class=" formStatus" id="status"
                                                                    name="status" onchange="dsd()">

                                                                    <option
                                                                        @if (app\models\Order::STATUS[$order->status] == 'Confirmed') selected @endif
                                                                        value="1" class="kt--bg-success ">Confirm
                                                                    </option>
                                                                    <option
                                                                        @if (app\models\Order::STATUS[$order->status] == 'Delivered') selected @endif
                                                                        value="2" class="kt--bg-success ">Delivered
                                                                    </option>
                                                                    <option
                                                                        @if (app\models\Order::STATUS[$order->status] == 'Canceled') selected @endif
                                                                        value="3" class="kt--bg-success ">Cancel
                                                                    </option>
                                                                </select>
                                                            @else
                                                                <select class=" formStatus" id="status"
                                                                    name="status"  onchange="dsd()">
                                                                    <option
                                                                        @if (app\models\Order::STATUS[$order->status] == 'Pending') selected @endif
                                                                        value="0" class="kt--bg-warning ">Pending
                                                                    </option>
                                                                    <option
                                                                        @if (app\models\Order::STATUS[$order->status] == 'Confirmed') selected @endif
                                                                        value="1" class="kt--bg-success ">Confirm
                                                                    </option>

                                                                    <option
                                                                        @if (app\models\Order::STATUS[$order->status] == 'Canceled') selected @endif
                                                                        value="3" class="kt--bg-success ">Cancel
                                                                    </option>
                                                                </select>
                                                            @endif

                                                        </form>
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


            <script src="assets/js/pages/crud/forms/widgets/bootstrap-select.js"></script>

            <script>
                function statusFunction(e) {


                  document.getElementById('ww').submit();

                }
               function dsd()
                {
                    $status = confirm('Are you sure?');
                    if ($status) {
                        var e = this;
                        statusFunction(e);
                    } else {
                        location.reload();
                    }
                }



            </script>

