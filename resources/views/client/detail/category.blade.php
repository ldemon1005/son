@extends('client.master')

@section('content')
    <section class="wrap-content bg-e2">
        <div class="box-product">
            <div class="container">
                <div class="row hidden-xs">
                    <div class="col-lg-3 col-md-4 box-product__sidebar">
                        <div class="bg-f h-100 position-relative">
                            <ul class="list-group">
                                @foreach($list_category as $categoryItem)
                                    <li class="{{$categoryItem->id == $category->id ? 'active' : ''}}">
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
                                <div class="col-12 product-info__name bd-bt-ea">
                                    <h4>Máy phát điện CUMMINS</h4>
                                </div>
                                <div class="col=lg-4 col-md-5 product-info__content bd-bt-ea">
                                    <div class="brand">
                                        <div class="brand-img">
                                            <img src="{{$category->image}}" alt="brand img">
                                        </div>
                                        <div class="brand-info">
                                            {!! $category->description2 !!}
                                        </div>
                                    </div>
                                    <div class="images slider">
                                        @foreach($category->slide_image as $image)
                                            <img src="{{$image}}" alt="product">
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col=lg-8 col-md-7 product-info__text bd-bt-ea">
                                    {!! $category->content !!}
                                </div>
                            </div>
                            <div class="row product-description">
                                <div class="col-12 product-description__title bd-bt-ea">
                                    <h4>Mã sản phẩm</h4>
                                    @if($category->listProduct($category->id))
                                        @foreach($category->listProduct($category->id) as $product)
                                            <div class="list-code">
                                                <div class="code-item md">
                                                    <span>
                                                        <a href="{{route('detail_product_view',['slug' => $product->slug . '---' . $product->id])}}">{{$product->code}}</a>
                                                    </span>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
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
                                            <a class="nav-link {{$categoryItem->id == $category->id ? 'active' : ''}}" href="{{route('detail_category_view',['slug' => $categoryItem->slug . '---' . $categoryItem->id])}}" role="tab" aria-controls="home"
                                               aria-selected="{{$categoryItem->id == $category->id ? 'true' : 'false'}}">{{$categoryItem->title_mobile}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="product-info__name product-name position-relative bd-bt-ea">
                                            <h4>{{$category->title}}</h4>
                                            <div class="dropdown list-codes">
                                                <button class="btn btn-default dropdown-toggle list-code-button" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-angle-double-down" aria-hidden="true"></i> MÃ SP
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                    @if($category->listProduct($category->id))
                                                        @foreach($category->listProduct($category->id) as $product)
                                                            <div class="col-3">
                                                                <a href="">{{$product->code}}</a>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-info__content bd-bt-ea">
                                            <div class="brand">
                                                <div class="brand-img">
                                                    <img src="{{$category->image}}" alt="brand img">
                                                </div>
                                                <div class="brand-info">
                                                    {!! $category->description2 !!}
                                                </div>
                                            </div>
                                            <div class="images slider">
                                                @foreach($category->slide_image as $image)
                                                    <img src="{{$image}}" alt="product">
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="product-info__text bd-bt-ea">
                                            {!! $category->content !!}
                                        </div>
                                        <div class="product-description">
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
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
                                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('client_script')
    <script>
        $(".images").slick({
            dots: true,
            infinite: true,
            centerMode: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            nextArrow: '<button type="button" class="slick-next"><img src="{{asset('client/imgs/chevron-right.png')}}" alt="next"></button>',
            prevArrow: '<button type="button" class="slick-prev"><img src="{{asset('client/imgs/chevron-left.png')}}" alt="prev"></button>',
        });
    </script>
@endsection
