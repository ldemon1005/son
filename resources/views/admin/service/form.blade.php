@extends('admin.master')

@section('content')
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <form  action="{{$service ? route('admin_update_service_action') : route('admin_create_service_action')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            @if($service)
                <input hidden name="id" value="{{$service->id}}">
            @endif
            <div class="row form-group">
                <div id="Service_Content" class="col-12 col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title font-bold">THÔNG TIN DỊCH VỤ</h4>
                            <div class="form-group">
                                <label for="service_title">Tiêu đề <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" id="service_title" aria-describedby="helpServiceTitle" placeholder="Nhập tiêu đề dịch vụ"
                                       autocomplete="off" value="{{$service ? $service->title : ''}}" required>
                                <small id="helpServiceTitle" class="form-text text-muted">Tiêu đề dịch vụ là bắt buộc</small>
                            </div>

                            <div class="form-group">
                                <label for="service_title">Tiêu đề phụ <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="sub_title" id="service_sub_title" aria-describedby="helpServiceSubTitle" placeholder="Nhập tiêu đề phụ dịch vụ"
                                       autocomplete="off" value="{{$service ? $service->sub_title : ''}}" required>
                                <small id="helpServiceTitle" class="form-text text-muted">Tiêu đề phụ dịch vụ là bắt buộc</small>
                            </div>

                            <div class="form-group">
                                <label for="service_title">Icon</label>
                                <input type="text" class="form-control" name="icon" id="service_icon" aria-describedby="helpServiceIcon" placeholder="Nhập icon dịch vụ"
                                       autocomplete="off" value="{{$service ? $service->icon : ''}}">
                                <small id="helpServiceTitle" class="form-text text-muted">Tham khảo trang web <a href="https://fontawesome.com/icons">https://fontawesome.com/icons</a></small>
                            </div>

                            <div class="form-group">
                                <label for="service_description">Mô tả ngắn</label>
                                <textarea class="form-control" name="description" id="service_description" rows="3">{{$service ? $service->description : ''}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="service_content">Nội dung</label>
                                <textarea class="form-control mce_editor" name="content" id="service_content" rows="3">{{$service ? $service->content : ''}}</textarea>
                            </div>

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title font-bold">CẤU HÌNH SEO</h4>
                            <div class="row form-group">
                                <label class="col-md-2 text-left" for="service_seo_title">SEO Tiêu đề</label>
                                <div class="col-md-10">
                                    <input type="text" name="seo_title" id="service_seo_title" class="form-control" maxlength="70"
                                           placeholder="" value="{{$service ? $service->seo_title : ''}}" autocomplete="off">
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-md-2 text-left" for="service_seo_title">SEO Mô tả</label>
                                <div class="col-md-10">
                                   <textarea name="seo_description" id="service_seo_description" class="form-control" rows="3"
                                             maxlength="170" placeholder="" autocomplete="off">{{$service ? $service->seo_description : ''}}</textarea>
                                </div>
                            </div><div class="row form-group">
                                <label class="col-md-2 text-left" for="service_seo_title">SEO Từ khóa</label>
                                <div class="col-md-10">
                                    <input type="text" name="seo_keyword" id="service_seo_keyword" class="form-control" data-role="tagsinput"
                                           placeholder="" value="{{$service ? $service->seo_keyword : ''}}" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="Service_Sidebar" class="col-12 col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title font-bold">ẢNH ĐẠI DIỆN</h4>
                            @include('admin.layouts.image_preview', ['input_name' => 'image', 'input_id' => 'service_image', 'input_image' => $service ? $service->image : ''])
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
                                        <input type="checkbox" class="custom-control-input" name="status" id="customSwitch1" {{$service && $service->status == 1 ? 'checked' : ''}}>
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
                            <a type="button" class="btn btn-danger" href="{{route('admin_list_service')}}"> Hủy</a>
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
