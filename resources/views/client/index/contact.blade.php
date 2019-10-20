@extends('client.master')

@section('content')
    <section class="wrap-content bg-e2">
        <div class="box-about">
            <div class="container">
                <div class="row bg-f pd-bt-24">
                    <div class="col-md-8">
                        <h4 class="default-title bd-bt-ea mg-bt-30 text-uppercase">CÔNG ty cổ phần máy phát điện thăng long</h4>
                        <div class="map mg-bt-30">
                            <iframe src="{{$config->link_map}}"
                                    width="100%" height="325" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                        </div>
                        <div class="list-img-company bd-bt-ea">
                            <img src="{{$config->logo}}" alt="image company">
                        </div>
                        <div class="row list-contact">
                            <div class="col-md-6 contact-item">
                                <span>Địa chỉ : {{$config->address_head}}</span>
                                <span>Điện thoại : {{$config->hotline}}</span>
                                <span>Email : {{$config->email}}</span>
                            </div>
                            <div class="col-md-6 contact-item">
                                <span>Địa chỉ : {{$config->address_representative}}</span>
                                <span>Điện thoại: {{$config->phone}}</span>
                                <span>Email : {{$config->email}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h4 class="default-title bd-bt-ea mg-bt-30 text-uppercase">Gửi tin nhắn cho chúng tôi</h4>
                        <form class="contact-form" method="post" action="{{route('contact_action')}}">
                            {{csrf_field()}}
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Họ và tên" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="phone" placeholder="Số điện thoại" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="title" placeholder="Tiêu đề" required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows="4" name="content" placeholder="Nội dung" required></textarea>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-default w-100" type="submit">GỬI TIN NHẮN</button>
                            </div>
                        </form>
                        <div class="img">
                            <img src="{{asset('client/imgs/phone-about.png')}}" alt="phone">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

