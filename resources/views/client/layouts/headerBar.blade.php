<section class="section-header-top">
    <div class="box-header-top">
        <ul class="list-group">
            <li class="hot-line c-f">
                <img src="{{asset('client/imgs/smartphone.png')}}" alt="hot line">
                <span>hot line: {{$config->hotline}}</span>
            </li>
            <li class="message pd-l-10">
                <a href="{{$config->facebook}}" target="_blank">
                    <img src="{{asset('client/imgs/Messenger.png')}}" alt="messenger">
                </a>
            </li>
            <li class="zalo">
                <a href="{{$config->zalo}}" target="_blank">
                    <img src="{{asset('client/imgs/zalo.png')}}" alt="zalo">
                </a>
            </li>
        </ul>
    </div>
</section>

<section class="section-header-menu">
    <div class="box-header-menu d-flex h-100">
        <div class="logo">
            <img src="{{$config->logo}}" alt="logo">
        </div>
        <div class="list-menu">
            <ul class="list-group h-100 hidden-xs">
                <li><a href="{{route('index_view')}}">Trang chủ</a></li>
                <li>
                    <a href="{{route('introduction_view')}}">Giới thiệu</a>
                </li>
                <li class="has-sub__menu">
                    Sản phẩm
                    <ul class="">
                        @foreach($list_category as $category)
                            <li><a href="{{route('detail_category_view',['slug' => $category->slug . '---' . $category->id])}}">{{$category->title}}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="has-sub__menu">
                    Dịch vụ
                    <ul class="">
                        @foreach($services as $service)
                            <li><a href="{{route('detail_service_view',['slug' => $service->slug . '---' . $service->id])}}">{{$service->title}}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li><a href="{{route('contact_view')}}">Liên hệ</a></li>
            </ul>
            <div class="nav-toggle pointer hidden-md">
                <span class="fa fa-bars"></span>
            </div>
        </div>
    </div>
    <div class="menu-mobile">

        <ul class="list-group">
            <li>
                <i class="fa fa-times cancel-menu-mobile position-absolute" aria-hidden="true"></i>
            </li>
            <li class="active"><a href="#">Trang chủ</a></li>
            <li>
                <a href="#">Giới thiệu</a>
            </li>
            <li class="has-sub__menu">
                Sản phẩm
                <ul class="">
                    @foreach($list_category as $category)
                        <li><a href="{{route('detail_category_view',['slug' => $category->slug . '---' . $category->id])}}">{{$category->title}}</a></li>
                    @endforeach
                </ul>
            </li>
            <li class="has-sub__menu">
                Dịch vụ
                <ul class="">
                    @foreach($services as $service)
                        <li><a href="{{route('detail_service_view',['slug' => $service->slug . '---' . $service->id])}}">{{$service->title}}</a></li>
                    @endforeach
                </ul>
            </li>
            <li><a href="#">Liên hệ</a></li>
        </ul>
    </div>
</section>
