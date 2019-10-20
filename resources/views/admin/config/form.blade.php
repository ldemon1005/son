@extends('admin.master')

@section('content')
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <form  action="{{route('admin_update_config_action')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <input hidden name="id" value="{{$config->id}}">
            <div class="row form-group">
                <div id="Post_Content" class="col-12 col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title font-bold">THÔNG cấu hình</h4>
                            <div class="form-group">
                                <label for="config_title">Tên <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" id="config_title" aria-describedby="helpPostTitle" placeholder="Nhập tên"
                                       autocomplete="off" value="{{$config->title}}" required>
                            </div>
                            <div class="form-group">
                                <label for="config_title">Địa chỉ nhà xưởng<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="address_factory" id="config_address_factory" aria-describedby="helpPostTitle" placeholder="Nhập địa chỉ nhà xưởng"
                                       autocomplete="off" value="{{$config->address_factory}}" required>
                            </div>
                            <div class="form-group">
                                <label for="config_title">Địa chỉ trụ sở<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="address_head" id="config_address_head" aria-describedby="helpPostTitle" placeholder="Nhập địa chỉ trụ sở"
                                       autocomplete="off" value="{{$config->address_head}}" required>
                            </div>
                            <div class="form-group">
                                <label for="config_title">Địa chỉ VPĐD<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="address_representative" id="config_address_representative" aria-describedby="helpPostTitle" placeholder="Nhập địa chỉ VPĐD"
                                       autocomplete="off" value="{{$config->address_representative}}" required>
                            </div>
                            <div class="form-group">
                                <label for="config_title">Link google map <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="link_map" id="config_address" aria-describedby="helpPostTitle" placeholder="Nhập link google map"
                                       autocomplete="off" value="{{$config->link_map}}" required>
                            </div>
                            <div class="form-group">
                                <label for="config_title">Email <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="email" id="config_email" aria-describedby="helpPostTitle" placeholder="Nhập địa chỉ email"
                                       autocomplete="off" value="{{$config->email}}" required>
                            </div>
                            <div class="form-group">
                                <label for="config_title">Hotline <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="hotline" id="config_address" aria-describedby="helpPostTitle" placeholder="Nhập hotline"
                                       autocomplete="off" value="{{$config->hotline}}" required>
                            </div>
                            <div class="form-group">
                                <label for="config_title">Số điện thoại <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="phone" id="config_phone" aria-describedby="helpPostTitle" placeholder="Nhập số điện thoại"
                                       autocomplete="off" value="{{$config->phone}}" required>
                            </div>
                            <div class="form-group">
                                <label for="config_title">Facebook <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="facebook" id="config_facebook" aria-describedby="helpFacebook" placeholder="Nhập facebook"
                                       autocomplete="off" value="{{$config->facebook}}" required>
                            </div>
                            <div class="form-group">
                                <label for="config_title">Zalo <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="zalo" id="config_zalo" aria-describedby="helpZalo" placeholder="Nhập zalo"
                                       autocomplete="off" value="{{$config->zalo}}" required>
                            </div>

                            <div class="form-group">
                                <label for="config_content">Content trang chủ</label>
                                <textarea class="form-control mce_editor" name="content_home" id="config_content" rows="3">{{$config->content_home}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="config_introduction">Content trang giới thiệu</label>
                                <textarea class="form-control mce_editor" name="content_introduction" id="config_introduction" rows="3">{{$config->content_introduction}}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title font-bold">CẤU HÌNH SEO</h4>
                            <div class="row form-group">
                                <label class="col-md-2 text-left" for="config_seo_title">SEO Tiêu đề</label>
                                <div class="col-md-10">
                                    <input type="text" name="seo_title" id="config_seo_title" class="form-control" maxlength="70"
                                           placeholder="" value="{{$config->seo_title}}" autocomplete="off">
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-md-2 text-left" for="config_seo_title">SEO Mô tả</label>
                                <div class="col-md-10">
                                   <textarea name="seo_description" id="config_seo_description" class="form-control" rows="3"
                                             maxlength="170" placeholder="" autocomplete="off">{{$config->seo_description}}</textarea>
                                </div>
                            </div><div class="row form-group">
                                <label class="col-md-2 text-left" for="config_seo_title">SEO Từ khóa</label>
                                <div class="col-md-10">
                                    <input type="text" name="seo_keyword" id="config_seo_keyword" class="form-control" data-role="tagsinput"
                                           placeholder="" value="{{$config->seo_keyword}}" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="Post_Sidebar" class="col-12 col-md-4">
                    <div class="card">
                        <div class="card-header" style="padding: 10px 0">
                            <h4>Ảnh banner trang chủ</h4>
                            <button type="button" class="btn btn-primary sm" onclick="addBannerHome('index')"><i class="fa fa-add"></i>Thêm barner</button>
                        </div>
                        <div class="card-body" id="banner-index">
                            @if(is_array($config->banner_index) && count($config->banner_index))
                                @foreach($config->banner_index as $key => $value)
                                    <div class="banner-index">
                                        @include('admin.layouts.image_preview', ['input_name' => 'banner_index[]', 'input_id' => $key, 'input_image' => $value])
                                    </div>
                                @endforeach
                            @else
                                <div class="banner-index">
                                    @include('admin.layouts.image_preview', ['input_name' => 'banner_index[]', 'input_id' => '0', 'input_image' => ''])
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title font-bold">ẢNH BANNER TRANG GIỚI THIỆU</h4>
                            @include('admin.layouts.image_preview', ['input_name' => 'banner_introduce', 'input_id' => 'banner_introduce_image', 'input_image' => $config ? $config->banner_introduce : ''])
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" style="padding: 10px 0">
                            <h4>Ảnh trang giới thiệu</h4>
                            <button type="button" class="btn btn-primary sm" onclick="addBannerHome('post')"><i class="fa fa-add"></i>Thêm barner</button>
                        </div>
                        <div class="card-body" id="banner-post">
                            @if(is_array($config->banner_post) && count($config->banner_post))
                                @foreach($config->banner_post as $index => $val)
                                    <div class="banner-post">
                                        @include('admin.layouts.image_preview', ['input_name' => 'banner_post[]', 'input_id' => $index + 10, 'input_image' => $val])
                                    </div>
                                @endforeach
                            @else
                                <div class="banner-post">
                                    @include('admin.layouts.image_preview', ['input_name' => 'banner_post[]', 'input_id' => '10', 'input_image' => ''])
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title font-bold">ẢNH LOGO TRANG WEB</h4>
                            @include('admin.layouts.image_preview', ['input_name' => 'logo', 'input_id' => 'logo_image', 'input_image' => $config ? $config->logo : ''])
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title font-bold">THAO TÁC</h4>

                            <button type="submit" class="btn btn-info"> Lưu</button>
                            <button type="button" class="btn btn-danger"> Hủy</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->

@endsection

@section('admin_css')
    <link href="{{asset('admin/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css')}}" rel="stylesheet">
@endsection

@section('admin_script')
    <script src="{{asset('admin/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')}}"></script>
    <!-- wysuhtml5 Plugin JavaScript -->
    <script src="{{asset('admin/assets/plugins/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('admin/main/js/cuongdev-form.js')}}"></script>
    <script>
        function addBannerHome(index){
            var name_class = '.banner-' + index + ':first';
            var element = $( name_class);
            var id = parseInt(element.find('input').attr('id'));
            console.log(id);
            var new_id = id + 1;
            var element_new = element.clone();
            var regex_str = new RegExp(id.toString(),"g");
            element_new.html(element_new.html().replace(regex_str,new_id));
            console.log(element_new.html())
            element_new.prependTo( "#banner-" + index );
        }
    </script>
@endsection
