
@extends('admin.adminpage')
@section('content_admin')
<div class="card card-custom">

    <div class="card-header">
        <h3 class="card-title">
            تعديل التصنيف
        </h3>
    </div>
    <!--begin::Form-->

    <form action="{{ route('update_category',$category->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
        {{--     {{ csrf_field() }}
            {{ method_field('post') }} --}}


            <div class="form-group row">
                <div class="col-12">
                    <div class='has-text-right'>الاسم</div >
                    <input type="text" name="name" class="form-control" value="{{$category->name }}">


                </div>
            </div>

            <div class="form-group row">
                <div class="col-12">
                    <div class='has-text-right'>الصورة</div>
                <input type="file" name="image" class="form-control" value="{{ old('image') }}">

                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>تعديل</button>
            </div>
        </div>

    </form><!-- end of form -->
    <!--end::Form-->
    @if (count($errors) > 0)
        @include('pages.general.errors',['errors'=> $errors->all()])
    @endif
</div>


@endsection
