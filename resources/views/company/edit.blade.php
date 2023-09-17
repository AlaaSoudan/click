
@extends('admin.adminpage')
@section('content_admin')
<div class="card card-custom">

    <div class="card-header">
        <h3 class="card-title">
        تعديل اسم الشركة
        </h3>
    </div>
    <!--begin::Form-->

    <form action="{{ route('update_company',$company->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
        {{--     {{ csrf_field() }}
            {{ method_field('post') }} --}}


            <div class="form-group row">
                <div class="col-12">
                    <label>Title</label>
                    <input type="text" name="name" class="form-control" value="{{ $company->name }}">
                </div>
            </div>



            <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>edit</button>
            </div>
        </div>

    </form><!-- end of form -->
    <!--end::Form-->
    @if (count($errors) > 0)
        @include('pages.general.errors',['errors'=> $errors->all()])
    @endif
</div>

@endsection
