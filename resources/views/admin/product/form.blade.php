@extends('admin.master')

@section('content')
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <form  action="{{$product ? route('admin_update_product_action') : route('admin_create_product_action')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            @if($product)
                <input hidden name="id" value="{{$product->id}}">
            @endif
            <div class="row form-group">
                <div id="Product_Content" class="col-12 col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title font-bold">THÔNG TIN SẢN PHẨM</h4>
                            <div class="form-group">
                                <label for="product_title">Tiêu đề <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" id="product_title" aria-describedby="helpProductTitle" placeholder="Nhập tiêu đề sản phẩm"
                                       autocomplete="off" value="{{$product ? $product->title : ''}}" required>
                                <small id="helpProductTitle" class="form-text text-muted">Tiêu đề sản phẩm là bắt buộc</small>
                            </div>
                            <div class="form-group">
                                <label for="product_title_mobile">Tiêu đề mobile <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title_mobile" id="product_title_mobile" aria-describedby="helpProductTitleMobile" placeholder="Nhập tiêu đề sản phẩm trên điện thoại"
                                       autocomplete="off" value="{{$product ? $product->title_mobile : ''}}" required>
                                <small id="helpProductTitle" class="form-text text-muted">Tiêu đề sản phẩm trên điện thoại là bắt buộc</small>
                            </div>
                            <div class="form-group">
                                <label for="post_content">Danh mục bài viết</label>
                                <select class="form-control" name="category_id">
                                    @foreach($list_category as $category)
                                        <option {{$product && $product->category_id == $category->id ? 'selected' : ''}} value="{{$category->id}}">{{$category->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="product_title">Mã sản phẩm <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="code" id="product_code" aria-describedby="helpProductCode" placeholder="Nhập mã sản phẩm"
                                       autocomplete="off" value="{{$product ? $product->code : ''}}" required>
                                <small id="helpProductCode" class="form-text text-muted">Mã sản phẩm là bắt buộc</small>
                            </div>
                            <div class="form-group">
                                <label for="product_content">Nội dung</label>
                                <textarea class="form-control mce_editor" name="content" id="product_content" rows="3">{{$product ? $product->content : ''}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="product_description">Mô tả ngắn</label>
                                <textarea class="form-control mce_editor" name="description" id="product_description" rows="3">{{$product ? $product->description : ''}}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title font-bold">CẤU HÌNH SEO</h4>
                            <div class="row form-group">
                                <label class="col-md-2 text-left" for="product_seo_title">SEO Tiêu đề</label>
                                <div class="col-md-10">
                                    <input type="text" name="seo_title" id="product_seo_title" class="form-control" maxlength="70"
                                           placeholder="" value="{{$product ? $product->seo_title : ''}}" autocomplete="off">
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-md-2 text-left" for="product_seo_title">SEO Mô tả</label>
                                <div class="col-md-10">
                                   <textarea name="seo_description" id="product_seo_description" class="form-control" rows="3"
                                             maxlength="170" placeholder="" autocomplete="off">{{$product ? $product->seo_description : ''}}</textarea>
                                </div>
                            </div><div class="row form-group">
                                <label class="col-md-2 text-left" for="product_seo_title">SEO Từ khóa</label>
                                <div class="col-md-10">
                                    <input type="text" name="seo_keyword" id="product_seo_keyword" class="form-control" data-role="tagsinput"
                                           placeholder="" value="{{$product ? $product->seo_keyword : ''}}" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="Product_Sidebar" class="col-12 col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title font-bold">ẢNH ĐẠI DIỆN</h4>
                            @include('admin.layouts.image_preview', ['input_name' => 'image', 'input_id' => 'product_image', 'input_image' => $product ? $product->image : ''])
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
                                        <input type="checkbox" class="custom-control-input" name="status" id="customSwitch1" {{$product && $product->status == 1 ? 'checked' : ''}}>
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
                            <a type="button" class="btn btn-danger" href="{{route('admin_list_product')}}"> Hủy</a>
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
@endsection
