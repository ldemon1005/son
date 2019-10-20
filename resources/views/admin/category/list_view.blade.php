@extends('admin.master')

@section('content')
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Danh mục tin tức
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Danh mục tin tức</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row form-group">
                <form method="get" action="{{route('admin_list_category')}}" id="search-form">
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="text" name="keyword" value="{{$params['keyword']}}" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                            <button type="submit" name="search" id="search-btn" class="btn btn-primary">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" onchange="$('#search-form').submit()" name="status">
                            <option value="9" selected>Tất cả</option>
                            <option {{isset($params['status']) && $params['status'] == 1 ? 'selected' : ''}} value="1">Hoạt động</option>
                            <option {{isset($params['status']) && $params['status'] == 0 ? 'selected' : ''}} value="0">Không hoạt động</option>
                        </select>
                    </div>
                </form>
                <div class="col-md-4 text-right">
                    <button type="button" id="add-category" class="btn btn-primary">Thêm mới</button>
                </div>
            </div>
            <table class="table table-bordered">
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Title</th>
                    <th style="width: 10%;text-align: center">Status</th>
                    <th style="width: 15%;text-align: center">Action</th>
                </tr>
                @foreach($list_category as $key => $category)
                    <tr>
                        <td>{{$key +1}}.</td>
                        <td>{{$category->title}}</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-{{$category->status == 1 ? 'success' : 'danger'}} btn-rounded btn-sm" data-toggle="tooltip" title="{{$category->status == 1 ? 'Hoạt động' : 'Không hoạt động'}}">
                                <i class="fa fa-{{$category->status == 1 ? 'eye' : 'eye-slash'}}"></i>
                            </button>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-success btn-rounded btn-sm btn__edit" data-toggle="tooltip" title="Chỉnh sửa"
                                    data-category_id="{{$category->id}}">
                                <i class="fa fa-pencil"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-rounded btn-sm btn__delete" data-category_id="{{$category->id}}" data-toggle="tooltip" title="Xoá">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                <div class="row form-group pull-right">
                    {{$list_category->links()}}
                </div>
            </table>
        </section>
        <!-- /.content -->

        <div class="modal" ref="category" id="category">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" action="{{route('admin_create_category')}}">
                        {{csrf_field()}}
                        <div class="modal-header">
                            <h4 class="modal-title">Thêm danh mục tin tức</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label>Mục đích sử dụng</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="title"/>
                                </div>
                            </div>
                        </div>

                        <div class="modal-body">
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label>Trạng thái</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" name="status" id="customSwitch1" checked>
                                        <label class="custom-control-label" for="customSwitch1">Hoạt động</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary btn-add-category">Thêm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal" ref="category" id="update-category">
        </div>
    </div>
@endsection

@section('admin_script')
    <script>
        $(document).ready(function () {
            $('#add-category').on('click', function (e) {
                $('#category').modal();
            });

            $('.btn__delete').on("click", function (e) {
                let category_id = $(this).attr("data-category_id");
                alertWarning(function () {
                    $.ajax({
                        type: "POST",
                        url: "{{route('admin_delete_category')}}",
                        data: {
                            id: category_id,
                            _token: "{{csrf_token()}}"
                        },
                        dataType: "json",
                        success: function (result) {
                            if (result.code === 1) {
                                toastSuccess(result.msg);
                                window.location.reload();
                            } else {
                                toastError(result.msg);
                            }
                        },
                        error: function (xhr) {
                            console.log(xhr);
                            toastError(xhr.responseJSON.msg);
                        }
                    });
                }, "Bạn có thực sự muốn xoá?");
            });

            $('.btn__edit').on("click", function (e) {
                let category_id = $(this).attr("data-category_id");
                $.ajax({
                    type: "GET",
                    url:  "update-category/" + category_id,
                    dataType: "json",
                    success: function (result) {
                        if (result.code === 1) {
                            $('#update-category').html(result.data);
                            $('#update-category').modal();
                        } else {
                            toastError(result.msg);
                        }
                    },
                    error: function (xhr) {
                        toastError(xhr.responseJSON.msg);
                    }
                });
            });
        });
    </script>
@endsection
