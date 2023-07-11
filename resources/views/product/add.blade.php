

<div class="card card-custom">

    <div class="card-header">
        <h3 class="card-title">
            Create product
        </h3>
    </div>
    <!--begin::Form-->

    <form action="{{ route('insert_product') }}" method="post" enctype="multipart/form-data">
        @csrf
       <div class="form-group row">
                    <div class="col-12">
                        <label>Parent Product</label>
                        <select class="form-control select2-selection__rendered " id="parent" name="parentId">
                            <option value=""></option>
                            <option value=" ">Null (Parent)</option>
                            @foreach ($parentProducts as $key => $product)
                                <option @if (old('parentId') == $product->id) selected @endif value="{{ $product->id }}">
                                    {{ $product->name }}</option>
                            @endforeach


                        </select>
                        <sub>Leave empty or select default if you are adding Parent Categort (level 1)</sub>
                    </div>
                </div>
                @if (old('parentId') != null)
                    <div class="form-group row">
                        <div class="col-12">
                            <label>name</label>
                            <input disabled type="text" id="title" name="name" class="form-control"
                                value="{{ request('name') }}">
                        </div>
                    </div>
                @else
                    <div class="form-group row">
                        <div class="col-12">
                            <label>name</label>
                            <input type="text" id="title" name="name" class="form-control"
                                value="{{ request('name') }}">
                        </div>
                    </div>
                @endif




                <div class="form-group row">
                    <div class="col-12">
                        <label>Description</label>
                        <div class="tinymce">
                            <textarea id="kt-tinymce-4" name="description" class="tox-target"  aria-hidden="true">
                                {{old('description')}}
                            </textarea>
                        </div>
                        <!--begin::Code-->
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-6">
                        <label>Price</label>
                        <input type="number" name="price" class="form-control" value="{{ old('price') }}">
                    </div>
{{--                     <div class="form-group row">
                        <div class="col-6">
                            <label>discount percent</label>
                            <input type="number" name="discount_percent" class="form-control" value="{{ old('discount_percent') }}">
                        </div>

                        <div class="col-6">
                            <label>discount active</label>
                            <select  id="country-dropdown" class="form-control" type="text" name="active_discount" class="form-control" value="{{ old('discount_price') }}">
                                <option   name="active_discount" class="form-control" value="Yes">yes</option>
                                <option  name="active_discount" class="form-control" value="NO"> No</option>

                            </select>
                        </div> --}}

                    <div class="col-6">
                        <label>image</label>
                        <div class="custom-file">
                            <input accept="image/*" type="file" class="custom-file-input"
                                id="image" name="image">
                            <label class="custom-file-label" for="image">Choose file</label>
                        </div>

{{--                             <input onchange="loadFile(event)" accept="image/*" type="file" class="custom-file-input"
                                id="image" name="image">
                            <label class="custom-file-label" for="image">Choose file</label>
                        </div>
                        <div id="imageReview" hidden class="symbol symbol-60 symbol-lg-60 p-3"> <img id="output" />
                        </div> --}}
                    </div>
                </div>



                <div class="form-group row">
                    <div class="col-4">
                        <label>Category</label>
                        @if (old('parentId') != null)
                            <select disabled name="category_id" class="form-control select2" id="category">
                                <option value=""></option>

                                @foreach ($categories as $category)
                                    <option @if (old('category_id') == $category->id) selected @endif value="{{ $category->id }}">
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        @else
                            <select name="category_id" class="form-control select2" id="category">
                                <option value=""></option>

                                @foreach ($categories as $category)
                                    <option @if (old('category_id') == $category->id) selected @endif value="{{ $category->id }}">
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>Add</button>
                </div>
            </div>

        </form><!-- end of form -->
    <!--end::Form-->
{{--     @if (count($errors) > 0)
        @include('pages.general.errors',['errors'=> $errors->all()])
    @endif --}}
</div>


