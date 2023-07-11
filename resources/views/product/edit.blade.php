

<div class="card card-custom">

    <div class="card-header">
        <h3 class="card-title">
            Create Category
        </h3>
    </div>
    <!--begin::Form-->

    <form action="{{ route('update_product',$product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
        {{--     {{ csrf_field() }}
            {{ method_field('post') }} --}}


            <input hidden type="text" name="product_id" class="form-control" value="{{ $product->id }}">
            <div class="form-group row">
                <div class="col-6">
                    <label>Title</label>
                    @if ($product->parentId != null)
                    <input disabled type="text" name="name" class="form-control" value="{{ $product->name }}">
                    @else
                    <input type="text" name="name" class="form-control" value="{{ $product->name }}">
                    @endif

                </div>
                <div class="col-6">
                    <label>Parent Product</label>
                    <select class="form-control select2" id="parent" name="parentId">
                        <option value=""></option>
                        <option value=" "> Level 1</option>
                        @foreach ($parentProducts as $key => $productP)
                            <option @if ($productP->id == $product->parentId) selected @endif value="{{ $productP->id }}">
                                {{ $productP->name }}</option>
                        @endforeach
                    </select>
                    <sub>Leave empty if you are adding Parent Categort (level 1)</sub>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-12">
                    <label>Description</label>
                    <div class="col-lg-12">
                        <!--begin::Card-->
                        <div class="example example-compact">
                            <div class="card-body">
                                <div class="tinymce">
                                    <textarea id="kt-tinymce-4" name="description" class="tox-target" value=  aria-hidden="true">
                                        {{$product->description}}
                                    </textarea>
                                </div>
                                <!--begin::Code-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="form-group row">
                <div class="col-6">
                    <label>Price</label>
                    <input type="number" name="price" class="form-control" value="{{ $product->price }}">
                </div>



                <div class="col-6">
                    <label>Image</label>
                    <div class="custom-file">
                        <input onchange="loadFile(event)" accept="image/*" type="file" class="custom-file-input"
                            id="image" name="image">
                        <label class="custom-file-label" for="image">Choose file</label>
                    </div>

                    <div id="imageReview" class="symbol symbol-60 symbol-lg-60 p-3"> <img id="output"
                            src="{{ url('storage/' . $product->imageUrl) }}" />
                    </div>
                </div>
            </div>



            <div class="form-group row">
                <div class="col-4">
                    <label>Category</label>
                    @if ($product->parentId != null)
                    <select disabled name="category_id" class="form-control select2" id="category">
                        <option value=""></option>
                        @foreach ($categories as $category)
                            <option @if ($category->id == $product->category_id) selected @endif value="{{ $category->id }}">
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                    @else
                    <select name="category_id" class="form-control select2" id="category">
                        <option value=""></option>
                        @foreach ($categories as $category)
                            <option @if ($category->id == $product->category_id) selected @endif value="{{ $category->id }}">
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                    @endif

                </div>



            </div>


            <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="flaticon-edit"></i>Update</button>
            </div>
        </div>

    </form><!-- end of form -->
    <!--end::Form-->
    @if (count($errors) > 0)
        @include('pages.general.errors',['errors'=> $errors->all()])
    @endif
</div>


