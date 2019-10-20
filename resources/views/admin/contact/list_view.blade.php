@extends('admin.master')

@section('content')
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Danh sách liên hệ
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Danh sách liên hệ</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row form-group">
                <form method="get" action="{{route('admin_list_contact')}}" id="search-form">
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
            </div>
            <table class="table table-bordered">
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Tên</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th style="width: 10%;text-align: center">Status</th>
                    <th style="width: 15%;text-align: center">Action</th>
                </tr>
                @foreach($list_contact as $key => $contact)
                    <tr>
                        <td>{{$key +1}}.</td>
                        <td>{{$contact->name}}</td>
                        <td>{{$contact->phone}}</td>
                        <td>{{$contact->email}}</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-{{$contact->status == 1 ? 'success' : 'danger'}} btn-rounded btn-sm" data-toggle="tooltip" title="{{$contact->status == 1 ? 'Đã xử lý' : 'Chưa xử lý'}}">
                                <i class="fa fa-{{$contact->status == 1 ? 'eye' : 'eye-slash'}}"></i>
                            </button>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-success btn-rounded btn-sm btn__edit" data-toggle="tooltip" title="Chỉnh sửa"
                                    data-contact_id="{{$contact->id}}">
                                <i class="fa fa-pencil"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-rounded btn-sm btn__delete" data-contact_id="{{$contact->id}}" data-toggle="tooltip" title="Xoá">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                <div class="row form-group pull-right">
                    {{$list_contact->links()}}
                </div>
            </table>
        </section>
        <!-- /.content -->

        <div class="modal" ref="contact" id="update-contact">
        </div>
    </div>
@endsection

@section('admin_script')
    <script>
        $(document).ready(function () {
            $('#add-contact').on('click', function (e) {
                $('#contact').modal();
            });

            $('.btn__delete').on("click", function (e) {
                let contact_id = $(this).attr("data-contact_id");
                alertWarning(function () {
                    $.ajax({
                        type: "POST",
                        url: "{{route('admin_delete_contact')}}",
                        data: {
                            id: contact_id,
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
                let contact_id = $(this).attr("data-contact_id");
                $.ajax({
                    type: "GET",
                    url:  "update-contact/" + contact_id,
                    dataType: "json",
                    success: function (result) {
                        if (result.code === 1) {
                            $('#update-contact').html(result.data);
                            $('#update-contact').modal();
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
