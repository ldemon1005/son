//ẢNH ĐẠI DIỆN
var win = null;

function open_popup_file_manager(img_id, fm_key) {
    var url = '/filemanager/dialog.php?type=1&popup=1&akey=' + fm_key + '&field_id=' + img_id;
    var w = 880;
    var h = 570;
    var l = Math.floor((screen.width - w) / 2);
    var t = Math.floor((screen.height - h) / 2);
    win = window.open(url, 'ResponsiveFilemanager', "scrollbars=1,width=" + w + ",height=" + h + ",top=" + t + ",left=" + l);
}

function responsive_filemanager_callback(field_id) {
    let image_preview = $('#' + field_id);
    let image_preview_val = image_preview.val();
    let res_image = '';
    if (/^[\],:{}\s]*$/.test(image_preview_val.replace(/\\["\\\/bfnrtu]/g, '@').replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']').replace(/(?:^|:|,)(?:\s*\[)+/g, ''))) {
        res_image = $.parseJSON(image_preview_val);
    } else {
        res_image = image_preview_val;
    }
    if ($.isArray(res_image)) {
        image_preview.val(res_image[0]);
    } else {
        image_preview.val(res_image);
    }
    update_image_preview(field_id);
    win.close();
}

function remove_image_preview(img_id) {
    let place_holder = $(".product_album".length > 0) ? '' : $('#' + img_id + '_preview').attr('data-default-image');
    $('#' + img_id).val(place_holder);
    update_image_preview(img_id);
}

function update_image_preview(img_id) {
    $('#' + img_id + '_preview').attr('src', $('#' + img_id).val());
}

//Copy to clipboard
function copy_to_clipboard(img_id) {
    $('#' + img_id).select();
    document.execCommand("copy");
    toastSuccess("Đã sao chép link ảnh!");
}

// SLUG
function getSlug(title_id, slug_id, type) {
    if (!title_id) {
        toastError("Title ID không được để trống");
    }

    if (!title_id) {
        toastError("Slug ID không được để trống");
    }

    if (!type) {
        toastError("Type không được để trống");
    }

    let str_title = $('#' + title_id).val();

    if (str_title.length > 0) {
        $.ajax({
            method: "POST",
            url: "/api/getSlug",
            data: {
                title: str_title,
                type: type,
                "_token": $("input[name='_token']").val(),
            }
        }).done(function (res) {
            if (res.code === 1) {
                $("#" + slug_id).val(res.data);
            } else {
                toastError("Không tạo được chuỗi đường dẫn tĩnh");
                $("#" + slug_id).val('');
            }
        });
    } else {
        toastError("Tiêu đề không được để trống");
        $("#" + slug_id).val('');
    }
}

function admin_tinymce(editor_class, height = 300) {
    if ($("." + editor_class).length > 0) {
        tinymce.init({
            selector: "textarea." + editor_class,
            language: 'vi_VN',
            theme: "modern",
            height: height,
            plugins: [
                "advlist autolink link image responsivefilemanager lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor"
            ],
            toolbar1: "formatselect bold italic underline blockquote bullist numlist alignleft aligncenter alignright alignjustify responsivefilemanager image media link unlink",
            toolbar2: "fontselect fontsizeselect outdent indent pastetext removeformat charmap forecolor insertdatetime emoticons table",
            fontsize_formats: "6px 8px 9px 10px 11px 12px 13px 14px 15px 16px 18px 20px 22px 24px 28px 30px 32px 34px 36px 38px 42px 46px 50px 54px 58px 62px 66px 70px",
            image_advtab: true,

            external_filemanager_path: "/filemanager/",
            filemanager_title: "Thư viện",
            external_plugins: {"filemanager": "/admin/assets/plugins/tinymce/plugins/responsivefilemanager/plugin.min.js"},
            filemanager_access_key: "CuongDevFileManagerKey",

            // enable title field in the Image dialog
            image_title: true,
            // enable automatic uploads of images represented by blob or data URIs
            automatic_uploads: true,
            // URL of our upload handler (for more details check: https://www.tinymce.com/docs/configure/file-image-upload/#images_upload_url)
            images_upload_url: '/api/uploadImage',
            // here we add custom filepicker only to Image dialog
            // file_picker_types: 'image',
            // and here's our custom image picker
            file_picker_callback: function (cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');

                // Note: In modern browsers input[type="file"] is functional without
                // even adding it to the DOM, but that might not be the case in some older
                // or quirky browsers like IE, so you might want to add it to the DOM
                // just in case, and visually hide it. And do not forget do remove it
                // once you do not need it anymore.

                input.onchange = function () {
                    var file = this.files[0];

                    var reader = new FileReader();
                    reader.onload = function () {
                        // Note: Now we need to register the blob in TinyMCEs image blob
                        // registry. In the next release this part hopefully won't be
                        // necessary, as we are looking to handle it internally.
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);

                        // call the callback and populate the Title field with the file name
                        cb(blobInfo.blobUri(), {title: file.name});
                    };
                    reader.readAsDataURL(file);
                };

                input.click();
            }
        });
    }
}

$(document).ready(function () {
    if ($(".mce_editor").length > 0) {
        admin_tinymce('mce_editor', 400);
    }

    $('form input').on('keyup keypress', function (e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });
});
