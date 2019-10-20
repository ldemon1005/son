@extends('client.master')

@section('content')
    <section class="wrap-content bg-e2">
        <div class="box-product">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4 box-product__sidebar">
                        <div class="bg-f h-100 position-relative">
                            <ul class="list-group">
                                @foreach($products as $productItem)
                                    <li class="{{$productItem->id == $product->id ? 'active' : ''}}">
                                        <a href="{{route('detail_product_view',['slug' => $productItem->slug . '---' . $productItem->id])}}">{{$productItem->title}}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="phone position-absolute">
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
                                    <h4>{{$product->title}}</h4>
                                </div>
                            </div>
                            <div class="row product-description">
                                <div class="col-12 product-description__text">
                                    {!! $product->content !!}
                                </div>
                            </div>

                            <div class="row product-description">
                                <div class="col-12 product-description__title bd-bt-ea">
                                    <h4>Mã sản phẩm</h4>
                                </div>
                                @foreach($product->codes as $code)
                                    <div class="col-2 product-description__text">
                                        {{$code}}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

