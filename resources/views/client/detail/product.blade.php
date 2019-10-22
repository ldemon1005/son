@extends('client.master')

@section('content')
    <section class="wrap-content bg-e2">
        <div class="box-product box-detail">
            <div class="container">
                <div class="row hidden-xs">
                    <div class="col-lg-3 col-md-4 box-product__sidebar">
                        <div class="bg-f h-100 position-relative">
                            <ul class="list-group">
                                @foreach($list_category as $categoryItem)
                                    <li class="{{$categoryItem->id == $product->category_id ? 'active' : ''}}">
                                        <a href="{{route('detail_category_view',['slug' => $categoryItem->slug . '---' . $categoryItem->id])}}">{{$categoryItem->title}}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="phone">
                                <div class="phone-content">
                                    <img src="{{asset('client/imgs/phone.png')}}" alt="phone">
                                    <span class="hot-line">HOTLINE: {{$config->hotline}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8">
                        <div class="box-product__content bg-f">
                            <div class="row product-info">
                                <div class="col-12 product-info__name position-relative bd-bt-ea">
                                    <h4>{{$product->title}} * {{$product->code}}</h4>
                                    <div class="brand-img">
                                        <img src="{{$product->getCategory ? $product->getCategory->image : ''}}" alt="brand img">
                                    </div>
                                </div>
                                <div class="col=lg-4 col-md-5 product-info__content bd-bt-ea">
                                    <div class="images">
                                        <img src="{{$product->image}}" alt="product">
                                    </div>
                                </div>
                                <div class="col=lg-8 col-md-7 product-info__text bd-bt-ea">
                                    {!! $product->description !!}
                                </div>
                            </div>
                            <div class="row product-description">
                                <div class="col-12 product-description__text pd-bt-43">
                                    {!! $product->content !!}
                                </div>
                            </div>
                            <div class="product-description">
                                <div class="product-description__title bd-bt-ea">
                                    <h4>Mã sản phẩm</h4>
                                    @if($category && $category->listProduct($category->id))
                                        @foreach($category->listProduct($category->id) as $product)
                                            <div class="row">
                                                <div class="col-3 code-item">
                                                                <span>
                                                                    <a href="{{route('detail_product_view',['slug' => $product->slug . '---' . $product->id])}}">{{$product->code}}</a>
                                                                </span>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
{{--                            <div class="row product-description">--}}
{{--                                <div class="col-12 product-description__title bd-bt-ea bd-t-ea">--}}
{{--                                    <h4>Mã sản phẩm</h4>--}}
{{--                                </div>--}}
{{--                                <div class="col-12 product-description__text">--}}
{{--                                    <p>--}}
{{--                                        Danh sách mã sản phẩm--}}
{{--                                    </p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
                <div class="row hidden-md">
                    <div class="col-12">
                        <div class="box-product__content bg-f">
                            <div class="product-info product-info-mobile">
                                <div class="product-info__name bd-bt-ea">
                                    <h4>CÁC DÒNG MÁY PHÁT ĐIỆN</h4>
                                </div>

                                <ul class="nav nav-tabs list-tab-products" id="listTabProduct" role="tablist">
                                    @foreach($list_category as $categoryItem)
                                        <li class="nav-item">
                                            <a class="nav-link {{$categoryItem->id == $product->category_id ? 'active' : ''}}" href="{{route('detail_category_view',['slug' => $categoryItem->slug . '---' . $categoryItem->id])}}" role="tab" aria-controls="home" aria-selected="{{$categoryItem->id == $product->category_id ? 'true' : 'false'}}">{{$categoryItem->title}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="product-info__name product-name position-relative bd-bt-ea pd-t-15">
                                            <h4>{{$product->title}} * {{$product->code}}</h4>
                                            <div class="brand-img">
                                                <img src="{{$product->getCategory ? $product->getCategory->image : ''}}" alt="brand img">
                                            </div>
                                        </div>
                                        <div class="product-info__content bd-bt-ea">
                                            <div class="images">
                                                <img src="{{$product->image}}" alt="product">
                                            </div>
                                        </div>
                                        <div class="product-info__text bd-bt-ea">
                                           {!! $product->description !!}
                                        </div>
                                        <div class="row product-description">
                                            <div class="col-12 product-description__text pd-bt-43">
                                                {!! $product->content !!}
                                            </div>
                                        </div>

                                       {{-- <div class="product-description">
                                            <div class="product-description__title bd-bt-ea">
                                                <h4>Mã sản phẩm</h4>
                                                @if($category->listProduct($category->id))
                                                    @foreach($category->listProduct($category->id) as $product)
                                                        <div class="row">
                                                            <div class="col-3 code-item">
                                                                <span>
                                                                    <a href="{{route('detail_product_view',['slug' => $product->slug . '---' . $product->id])}}">{{$product->code}}</a>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>--}}
{{--                                        <div class="product-description pd-0">--}}
{{--                                            <div class="product-description__text pd-bt-43">--}}
{{--                                                <p>--}}
{{--                                                    Nội dung mô tả--}}
{{--                                                </p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="product-description pd-0">--}}
{{--                                            <div class="product-description__title bd-bt-ea bd-t-ea">--}}
{{--                                                <h4>Mã sản phẩm</h4>--}}
{{--                                            </div>--}}
{{--                                            <div class="product-description__text">--}}
{{--                                                <p>--}}
{{--                                                    Danh sách mã sản phẩm--}}
{{--                                                </p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

