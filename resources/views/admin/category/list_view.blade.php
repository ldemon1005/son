@extends('admin.master')

@section('content')
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Danh mục sản phẩm
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Danh mục sản phẩm</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row form-group">
                <form method="get" action="{{route('admin_list_category')}}" id="search-form">
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" name="keyword" value="{{$params['keyword']}}" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                            <button type="submit" name="search" id="search-btn" class="btn btn-primary">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select class="form-control" onchange="$('#search-form').submit()" name="status">
                            <option value="9" selected>Tất cả</option>
                            <option {{isset($params['status']) && $params['status'] == 1 ? 'selected' : ''}} value="1">Hoạt động</option>
                            <option {{isset($params['status']) && $params['status'] == 0 ? 'selected' : ''}} value="0">Không hoạt động</option>
                        </select>
                    </div>
                </form>
                <div class="col-md-3 text-right">
                    <a type="button" id="add-category" class="btn btn-primary" href="{{route('admin_update_category_view',['id' => 0])}}">Thêm mới</a>
                </div>
            </div>
            <table class="table table-bordered">
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th style="width: 10%;text-align: center">Status</th>
                    <th style="width: 15%;text-align: center">Action</th>
                </tr>
                @foreach($list_category as $key => $category)
                    <tr>
                        <td>{{$key + 1}}.</td>
                        <td>{{$category->title}}</td>
                        <td><img height="30" class="image_preview" src="{{$category->image ? $category->image : asset('img/placeholder.png')}}"></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-{{$category->status == 1 ? 'success' : 'danger'}} btn-rounded btn-sm" data-toggle="tooltip" title="{{$category->status == 1 ? 'Hoạt động' : 'Không hoạt động'}}">
                                <i class="fa fa-{{$category->status == 1 ? 'eye' : 'eye-slash'}}"></i>
                            </button>
                        </td>
                        <td class="text-center">
                            <a type="button" class="btn btn-success btn-rounded btn-sm btn__edit" href="{{route('admin_update_category_view', ['id' => $category->id])}}" data-toggle="tooltip" title="Chỉnh sửa">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <a type="button" class="btn btn-danger btn-rounded btn-sm btn__delete" data-category_id="{{$category->id}}" data-toggle="tooltip" title="Xoá">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                <div class="row form-group pull-right">
                    {{$list_category->links()}}
                </div>
            </table>
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('admin_script')
    <script>
        $(document).ready(function () {
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
        });
    </script>
@endsection
