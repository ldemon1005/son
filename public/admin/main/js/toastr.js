function toastSuccess(heading, text = '') {
    $.toast({
        heading: heading,
        text: text,
        position: 'top-right',
        loaderBg: '#ff6849',
        icon: 'success',
        hideAfter: 3000,
        stack: 1
    });
}

function toastError(heading, text = '') {
    $.toast({
        heading: heading,
        text: text,
        position: 'top-right',
        loaderBg: '#ff6849',
        icon: 'error',
        hideAfter: 3000,
        stack: 1
    });
}

function toastWarning(heading, text = '') {
    $.toast({
        heading: heading,
        text: text,
        position: 'top-right',
        bgColor: '#ffc107',
        loaderBg: '#ff6849',
        icon: 'warning',
        hideAfter: 3000,
        stack: 1
    });
}

function toastInfo(heading, text = '') {
    $.toast({
        heading: heading,
        text: text,
        position: 'top-right',
        loaderBg: '#ff6849',
        icon: 'info',
        hideAfter: 3000,
        stack: 1
    });
}

function alertWarning(callback, title = "Are you sure?", text = '') {
    swal({
        title: title,
        text: text,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        cancelButtonText: "Không",
        confirmButtonText: "Có",
        closeOnConfirm: true
    }, callback);
}

