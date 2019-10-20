@extends('client.master')

@section('content')
    <section class="wrap-content bg-e2">
        <div class="box-product">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4 service-sidebar box-product__sidebar">
                        <div class="bg-f h-100 position-relative">
                            <ul class="list-group">
                                @foreach($services as $serviceItem)
                                    <li class="{{$serviceItem->id == $service->id ? 'active' : ''}}">
                                        <a href="{{route('detail_service_view',['slug' => $serviceItem->slug . '---' . $serviceItem->id])}}">
                                            {!! $serviceItem->icon !!} {{$serviceItem->title}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <ul class="list-group list-brand">
                                <li class="list-brand__title">
                                    <b> CÁC HÃNG SẢN PHẨM</b>
                                </li>
                                <li class="text-center">
                                    <img src="{{asset('client/imgs/brand-1.png')}}" alt="brand">
                                </li>
                                <li class="text-center">
                                    <img src="{{asset('client/imgs/brand-2.png')}}" alt="brand">
                                </li>
                                <li class="text-center">
                                    <img src="{{asset('client/imgs/brand-3.png')}}" alt="brand">
                                </li>
                                <li class="text-center">
                                    <img src="{{asset('client/imgs/brand-4.png')}}" alt="brand">
                                </li>
                                <li class="text-center">
                                    <img src="{{asset('client/imgs/brand-5.png')}}" alt="brand">
                                </li>
                                <li class="text-center">
                                    <img src="{{asset('client/imgs/brand-6.png')}}" alt="brand">
                                </li>
                                <li class="text-center">
                                    <img src="{{asset('client/imgs/brand-8.png')}}" alt="brand">
                                </li>
                            </ul>
                            <div class="phone">
                                <div class="phone-content">
                                    <i class="fas fa-mobile-alt"></i>
                                    <span class="hot-line">HOTLINE: {{$config->hotline}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8">
                        <div class="box-product__content bg-f">
                            <div class="row product-info">
                                <div class="col-12 product-info__name bd-bt-ea">
                                    <h4 style="font-size: 29px; font-weight: normal">{{$service->sub_title}}</h4>
                                </div>
                            </div>
                            <div class="row service-content">
                                <p>
                                    {!! $service->content !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

