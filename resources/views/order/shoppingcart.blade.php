@extends('layouts.app')
@section('content')
    <section class="section has-background-light is-clipped">
        <div class="container">
            <div class="has-background-white p-8 p-20-desktop">
                <h2 class=" has-text-right title mb-8 mb-20-tablet">مشتريات</h2>
                <div class="columns is-multiline is-vcentered">
                    <div class="column is-12 is-8-widescreen mb-8 mb-0-widescreen">
                        <div class="is-hidden-touch columns is-multiline" style="border-bottom: 1px solid grey;">
                            <div class="column is-3">
                                <h4 class="has-text-grey has-text-weight-bold mb-6" style="font-size: 16px;">المادة</h4>
                            </div>
                            <div class="column is-2">
                                <h4 class="has-text-grey has-text-weight-bold mb-6" style="font-size: 16px;">السعر</h4>
                            </div>
                            <div class="column is-2 has-text-centered">
                                <h4 class="has-text-grey has-text-weight-bold mb-6" style="font-size: 16px;">الكمية</h4>
                            </div>
                            <div class="column is-2">
                                <h4 class="has-text-grey has-text-weight-bold mb-6" style="font-size: 16px;">السعر للمادة
                                </h4>
                            </div>
                            <div class="column is-2">
                                <h4 class="has-text-grey has-text-weight-bold mb-6" style="font-size: 16px;">الغاء</h4>
                            </div>
                        </div>
                        <div class="mb-12 py-3">

                            @foreach ($items as $item)
                                <div class="mb-3 mb-3-tablet columns is-vcentered is-multiline">
                                    <div class="column is-3">
                                        <h3 class="subtitle mb-2 has-text-weight-bold">{{ $item->name }}</h3>

                                    </div>

                                    <div class="column is-2">
                                        <h3 class="subtitle mb-2 has-text-weight-bold">{{ $item->price }}</h3>

                                    </div>
                                    <div class="column is-2">
                                        <h3 class="subtitle mb-2 has-text-weight-bold">{{ $item->quantity }}</h3>

                                    </div>
                                    <div class="column is-2">
                                        <h3 class="subtitle mb-2 has-text-weight-bold">{{ $item->quantity  * $item->price}}</h3>

                                    </div>
                                    <div class="column is-2">
                                        <p class="subtitle has-text-info has-text-weight-bold"> <a
                                                class="btn btn-sm btn-clean btn-icon"
                                                onclick="return confirm('Are you sure?')"
                                                href="{{ route('delete_pro_orders', $item->id) }}"
                                                class="btn btn-sm btn-clean btn-icon">حذف
                                                <i class="icon-1x text-dark-50 flaticon-delete"></i>
                                            </a></p>
                                    </div>

                                </div>

                            @endforeach


                        </div>
                        <form action="{{ route('adding_order') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <div class="column is-4">
                                    <span class="is-flex-shrink-0 has-text-weight-bold">ملاحظة</span>
                                </div>
                                <div class="column is-5">
                                    <input class="ms-12 input has-text-weight-bold" type="text" name="note"
                                        class="form-control" value="{{ old('note') }} "placeholder="ملاحظة">
                                    <div class="form-group">
                                        <button type="submit"class="column is-9 ms-6 button is-dark is-flex-shrink-0"><i
                                                class="fa fa-plus"></i>أرسال الطلب </button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="column is-12 is-4-widescreen">
                        <div class="has-background-info p-6 p-16-desktop">
                            <h3 class="title is-size-3 has-text-white mb-6">إجمالي الطلب</h3>
                            <div class="mb-8 pb-5 is-flex is-justify-content-space-between is-align-items-center"
                                style="border-bottom: 1px solid rgba(255, 255, 255, 0.3);">
                                <span class="has-text-light">
                                    السعر كامل
                                </span>
                                <span class="subtitle has-text-white has-text-weight-bold">{{ $total }}</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
