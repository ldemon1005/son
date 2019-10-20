@extends('client.master')

@section('content')
    <section class="introduce-banner position-relative" style="background-image: url('{{$config->banner_introduce}}')">
        <div class="container">
            <div class="row">
                <div class="banner-text position-absolute">
                    <h3 class="company-name">{{$config->title}}</h3>
                    <h3 class="company-type">JSC</h3>
                </div>
            </div>
        </div>
    </section>

    <section class="wrap-content bg-e2">
        <div class="box-introduce">
            <div class="container">
                <div class="row pd-bt-24 hidden-xs">
                    <div class="col-md-9">
                        <div class="bg-f">
                            {!! $config->content_introduction !!}
                        </div>
                    </div>
                    <div class="col-md-3 box-introduce__sidebar">
                        @foreach($config->banner_post as $image)
                            <div class="img-item pd-t-43 pd-bt-43 bg-c2">
                                <img src="{{$image}}" alt="introduce banner">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

