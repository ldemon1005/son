<section class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-12 info-company">
                <div class="box-footer-info">
                    <span>Nhà xưởng: {{$config->address_factory}}</span><br>
                    <span>Trụ sở: {{$config->address_head}}</span><br>
                    <span>VPĐD: {{$config->address_representative}}</span><br>
                    <span>Điện thoại : {{$config->phone}}</span><br>
                    <span>Email : {{$config->email}}</span><br>
                </div>
            </div>
            <div class="col-md-6 col-12 tag-product">
                <div class="box-footer-info">
                    @if($list_category)
                        @foreach($list_category as $category)
                            <span class="tag-item"><a href="{{route('detail_product_view',['slug' => $category->slug . '---' . $category->id])}}">{{$category->title_mobile}}</a></span>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
