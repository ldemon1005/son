<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Free Web tutorials">
    <meta name="keywords" content="HTML,CSS,XML,JavaScript">
    <meta name="author" content="John Doe">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Máy phát thăng long</title>
</head>
<body>
<!-- endbuild -->
@yield('client_css')
<link href="{{asset('admin/assets/plugins/toast-master/css/jquery.toast.css')}}" rel="stylesheet">
<!--alerts CSS -->
<link href="{{asset('admin/assets/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css">


<!-- build:css css/styles.min.css-->
<link rel="stylesheet" href="{{asset('client/css/style.css?v=1.1.1')}}">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="{{asset('client/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('client/css/slick.css')}}">
<link rel="stylesheet" href="{{asset('client/css/slick-theme.css')}}">
<!-- build:css css/styles.min.css-->
<link rel="stylesheet" href="{{asset('client/css/custom.css')}}">
<link rel="stylesheet" href="{{asset('client/css/style.css')}}">


<script src="https://kit.fontawesome.com/28e48251f0.js"></script>
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{asset('client/js/popper.min.js')}}"></script>
<!-- Toastr -->
<script src="{{asset('admin/assets/plugins/toast-master/js/jquery.toast.js')}}"></script>
<script src="{{asset('admin/main/js/toastr.js')}}"></script>
<!-- Sweet-Alert  -->
<script src="{{asset('admin/assets/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/select2/dist/js/select2.full.min.js')}}"></script>
<!-- ============================================================== -->
<!-- Style switcher -->
<!-- ============================================================== -->
<script src="{{asset('admin/assets/plugins/styleswitcher/jQuery.style.switcher.js')}}"></script>

<!-- build:js js/custom.min.js-->
<!-- endbuild -->
<div class="common-overlay" onclick="hiddenMenuMobile()"></div>
<div class="box-main page-ttdn">
    @include('client.layouts.headerBar')
    @yield('content')
    @include('client.layouts.footer')
</div>

<script>
    $('.select2').select2();
</script>

<script type="text/javascript" src="{{asset('client/js/lib/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('client/js/lib/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('client/js/lib/fa_icon.js')}}"></script>
<script type="text/javascript" src="{{asset('client/js/lib/slick.js')}}"></script>
<script type="text/javascript" src="{{asset('client/js/custom.js')}}"></script>

@include('client.layouts.notification')
@yield('client_script')
</body>

</html>
