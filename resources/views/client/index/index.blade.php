@extends('client.master')

@section('content')
    <section class="main-content">
        <div class="introduce">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 col-12 col-left">
                        <div class="col-left__content">
                            {!! $config->content_home !!}
                            <button class="btn btn-default btn-seen">
                                Xem thêm
                            </button>
                        </div>
                    </div>
                    <div class="col-md-5 col-12 col-right">
                        <img src="{{asset('client/imgs/Machines.png')}}" alt="introduce product">
                    </div>
                </div>
            </div>
        </div>

        <div class="services">
            <div class="container">
                <div class="row">
                    @foreach($services as $key => $service)
                        <div class="col-md-4 col-12 service-item">
                            <a href="{{route('detail_service_view',['slug' => $service->slug . '---' . $service->id])}}">
                                <img src="{{$service->image}}" alt="{{$service->title}}">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="hot-products">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="hot-products__title d-flex">
                            <h3><i>Sản phẩm</i></h3>
                            <div class="hot-products__title-hr">
                                <img src="{{asset('client/imgs/hr_product.png')}}" alt="Sản phẩm">
                            </div>
                        </div>
                    </div>
                    @foreach($products as $product)
                        <div class="col-md-4 col-12 hot-product-item">
                            <a href="{{route('detail_product_view',['slug' => $product->slug . '---' . $product->id])}}">
                                <div class="hot-product-item__title">
                                    <h3>{{$product->title}}</h3>
                                </div>
                                <div class="hot-product-item__content">
                                    {!! $product->description !!}
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

@endsection

