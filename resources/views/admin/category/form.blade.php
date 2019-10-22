@extends('admin.master')

@section('content')
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <form  action="{{$category ? route('admin_update_category_action') : route('admin_create_category_action')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            @if($category)
                <input hidden name="id" value="{{$category->id}}">
            @endif
            <div class="row form-group">
                <div id="Product_Content" class="col-12 col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title font-bold">THÔNG TIN DANH MỤC</h4>
                            <div class="form-group">
                                <label for="category_title">Tiêu đề <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" id="category_title" aria-describedby="helpProductTitle" placeholder="Nhập tiêu đề sản phẩm"
                                       autocomplete="off" value="{{$category ? $category->title : ''}}" required>
                                <small id="helpProductTitle" class="form-text text-muted">Tiêu đề sản phẩm là bắt buộc</small>
                            </div>
                            <div class="form-group">
                                <label for="category_title_mobile">Tiêu đề mobile <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title_mobile" id="category_title_mobile" aria-describedby="helpProductTitle" placeholder="Nhập tiêu đề sản phẩm trên mobile"
                                       autocomplete="off" value="{{$category ? $category->title_mobile : ''}}" required>
                                <small id="helpProductTitle" class="form-text text-muted">Tiêu đề sản phẩm trên mobile là bắt buộc</small>
                            </div>
                            <div class="form-group">
                                <label for="category_description">Mô tả ngắn 1</label>
                                <textarea class="form-control mce_editor" name="description1" id="category_description1" rows="1">{{$category ? $category->description1 : ''}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="category_description">Mô tả ngắn 2</label>
                                <textarea class="form-control mce_editor" name="description2" id="category_description2" rows="1">{{$category ? $category->description2 : ''}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="category_content">Nội dung</label>
                                <textarea class="form-control mce_editor" name="content" id="category_content" rows="3">{{$category ? $category->content : ''}}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title font-bold">CẤU HÌNH SEO</h4>
                            <div class="row form-group">
                                <label class="col-md-2 text-left" for="category_seo_title">SEO Tiêu đề</label>
                                <div class="col-md-10">
                                    <input type="text" name="seo_title" id="category_seo_title" class="form-control" maxlength="70"
                                           placeholder="" value="{{$category ? $category->seo_title : ''}}" autocomplete="off">
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-md-2 text-left" for="category_seo_title">SEO Mô tả</label>
                                <div class="col-md-10">
                                   <textarea name="seo_description" id="category_seo_description" class="form-control" rows="3"
                                             maxlength="170" placeholder="" autocomplete="off">{{$category ? $category->seo_description : ''}}</textarea>
                                </div>
                            </div><div class="row form-group">
                                <label class="col-md-2 text-left" for="category_seo_title">SEO Từ khóa</label>
                                <div class="col-md-10">
                                    <input type="text" name="seo_keyword" id="category_seo_keyword" class="form-control" data-role="tagsinput"
                                           placeholder="" value="{{$category ? $category->seo_keyword : ''}}" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="Product_Sidebar" class="col-12 col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title font-bold">ẢNH ĐẠI DIỆN</h4>
                            @include('admin.layouts.image_preview', ['input_name' => 'image', 'input_id' => 'category_image', 'input_image' => $category ? $category->image : ''])
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" style="padding: 10px 0">
                            <h4>Slide show</h4>
                            <button type="button" class="btn btn-primary sm" onclick="addBannerHome('category')"><i class="fa fa-add"></i>Thêm ảnh</button>
                        </div>
                        <div class="card-body" id="banner-category">
                            @if(is_array($category->slide_image) && count($category->slide_image))
                                @foreach($category->slide_image as $index => $val)
                                    <div class="banner-category">
                                        @include('admin.layouts.image_preview', ['input_name' => 'slide_image[]', 'input_id' => $index + 10, 'input_image' => $val])
                                    </div>
                                @endforeach
                            @else
                                <div class="banner-category">
                                    @include('admin.layouts.image_preview', ['input_name' => 'slide_image[]', 'input_id' => '10', 'input_image' => ''])
                                </div>
                            @endif
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-body">
                            <div class="row form-group" style="padding: 10px 0">
                                <div class="col-md-4">
                                    <label>Trạng thái</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" name="status" id="customSwitch1" {{$category && $category->status == 1 ? 'checked' : ''}}>
                                        <label class="custom-control-label" for="customSwitch1">Hoạt động</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title font-bold">THAO TÁC</h4>

                            <button type="submit" class="btn btn-info"> Lưu</button>
                            <a type="button" class="btn btn-danger" href="{{route('admin_list_category')}}"> Hủy</a>
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
