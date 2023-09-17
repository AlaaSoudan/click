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

                            <span class="fa fa-table">&nbsp;</span> المستخدمون


                        </span>
                    </h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                @if (!count($user) == 0)
                    <div class="card-body pt-0 pb-3">
                        <div class="tab-content">
                            <!--begin::Table-->
                            <div class="table-responsive">
                                <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                                    <thead>
                                        <tr class="text-uppercase">
                                            <th>الاسم </th>
                                            <th>صيدلية</th>
                                            <th>العنوان</th>
                                            <th>موبايل</th>


                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($user as $users)

                                            <tr>

                                                <td>{{ $users->name }}</td>
                                                <td>{{ $users->pharmacy }}</td>
                                                <td>{{ $users->address }}</td>
                                                <td>{{ $users->mobile }}</td>






                                           {{-- d --}}

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
