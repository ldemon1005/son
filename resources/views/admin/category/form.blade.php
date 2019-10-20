<div class="modal-dialog">
    <div class="modal-content">
        <form method="post" action="{{route('admin_update_category_action')}}">
            {{csrf_field()}}
            <input hidden value="{{$category->id}}" name="id">
            <div class="modal-header">
                <h4 class="modal-title">Thêm danh mục tin tức</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="row form-group">
                    <div class="col-md-4">
                        <label>Tên danh mục</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="title" value="{{$category->title}}"/>
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
                            <input type="checkbox" class="custom-control-input" name="status" id="customSwitch1" {{$category->status == 1 ? 'checked' : ''}}>
                            <label class="custom-control-label" for="customSwitch1">Hoạt động</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-primary btn-add-category">Lưu</button>
            </div>
        </form>
    </div>
</div>
