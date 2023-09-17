
@extends('admin.adminpage')
@section('content_admin')
    <div class="card card-custom">

        <div class="card-header">
            <h3 class="card-title">
                إنشاء تصنيف
            </h3>
        </div>
        <!--begin::Form-->

        <form action="{{ route('insert_category') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
            {{--     {{ csrf_field() }}
                {{ method_field('post') }} --}}


                <div class="form-group row">
                    <div class="col-12">
                        <div class="has-text-right">الاسم</div>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-12">
                        <div class="has-text-right">صورة</div>
                    <input type="file" name="image" class="form-control" value="{{ old('image') }}">

                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>إضافة</button>
                </div>
            </div>

        </form><!-- end of form -->
        <!--end::Form-->
        @if (count($errors) > 0)
            @include('pages.general.errors',['errors'=> $errors->all()])
        @endif
    </div>


@endsection
