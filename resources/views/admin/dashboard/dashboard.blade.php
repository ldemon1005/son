@extends('admin.master')

@section('content')
    <div>

        <!-- Main content -->
        <section class="content">
            <p>Chào mừng bạn quay trở lại với hệ thống</p>

            @foreach($products as $product)
                <div class="row">
                    <label class="col-md-4">{{$product->status == 1 ? 'Số sản phẩm đang đăng' : 'Số sản phẩm không đăng'}}</label>
                    <div class="col-md-8">
                        {{$product->total}}
                    </div>
                </div>
            @endforeach
        </section>
        <!-- /.content -->
    </div>
@endsection
