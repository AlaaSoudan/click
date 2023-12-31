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
                            الشركات
                        </span>
                    </h3>
                    <!--begin::Actions-->
                    <div class="my-lg-0 my-1">
                        <a class="btn btn-sm btn-primary font-weight-bolder text-uppercase"
                            href="{{ route('add_company') }}">إضافة شركة</a>
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

                            <span class="fa fa-table">&nbsp;</span> كل الشركات


                        </span>
                    </h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                @if (!count($companies) == 0)
                    <div class="card-body pt-0 pb-3">
                        <div class="tab-content">
                            <!--begin::Table-->
                            <div class="table-responsive">
                                <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                                    <thead>
                                        <tr class="text-uppercase">
                                            <th></th>
                                            <th>الاسم</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($companies as $company)

                                            <tr>
                                                <td>
                                                    <div class="symbol symbol-50 flex-shrink-0 mr-4">

                                                        <div class="symbol-label"
                                                            style="background-image: url('{{ url('storage/' . $company->imageUrl) }}')">
                                                        </div>

                                                    </div>
                                                </td>

                                                <td>{{ $company->name }}</td>

                                                <td>

                                                    <a class="btn btn-sm btn-clean btn-icon"
                                                        href="{{ route('edit_company', $company->id) }}">
                                                        edit
                                                        <i class="icon-1x text-dark-50 flaticon-edit-1"></i>
                                                    </a>
                                                    <a class="btn btn-sm btn-clean btn-icon"
                                                        onclick="return confirm('Are you sure?')"
                                                        href="{{ route('delete_company', $company->id) }}"
                                                        class="btn btn-sm btn-clean btn-icon"> delete
                                                        <i class="icon-1x text-dark-50 flaticon-delete"></i>
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
