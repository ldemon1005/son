<input type="text" name="{{$input_name}}" id="{{$input_id}}" class="d-none" onchange="update_image_preview('{{$input_id}}')" value="{{$input_image ? $input_image : ''}}"/>
<div class="image_preview_wrapper">
    <div class="image_preview_action">
        <button class="btn btn-info btn-sm" type="button" onclick="open_popup_file_manager('{{$input_id}}', 'CuongDevFileManagerKey')">
            <i class="fa fa-image" aria-hidden="true"></i>
        </button>
        <button type="button" class="btn btn-danger btn-sm" onclick="remove_image_preview('{{$input_id}}')"><i class="fa fa-trash" aria-hidden="true"></i></button>
    </div>
    <div class="image_wrapper" onclick="open_popup_file_manager('{{$input_id}}', 'CuongDevFileManagerKey')">
        <img id="{{$input_id}}_preview" class="image_preview" src="{{$input_image ? $input_image : ''}}" alt="" data-default-image="{{asset('img/placeholder.png')}}">
    </div>
</div>
