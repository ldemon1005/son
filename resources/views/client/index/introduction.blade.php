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
                        @foreach($config->banner_post as $key => $image)

                            @if($key % 3 == 0 )
                                <div class="img-item pd-t-63 pd-bt-63 bg-c2">
                                    <img src="{{$image}}" alt="introduce banner">
                                </div>
                            @endif
                            @if($key % 3 == 1 )
                                <div class="img-item pd-t-201 pd-bt-201 bg-f">
                                    <img src="{{$image}}" alt="introduce banner">
                                </div>
                            @endif
                            @if($key % 3 == 2 )
                                <div class="img-item pd-t-201 pd-bt-201 bg-ad">
                                    <img src="{{$image}}" alt="introduce banner">
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

