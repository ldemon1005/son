@extends('admin.master')

@section('admin_main')
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper">
        <div class="login-register" style="background-image:url({{$web_setting['ta_login_background'] ?? asset('admin/assets/images/background/login-register.jpg')}});">
            {{--<video id="bg_login_video" autoplay muted loop width="1280" height="720">--}}
                {{--<source type="video/mp4" src="{{asset('admin/assets/images/background/login-bg.mp4')}}">--}}
                {{--<source type="video/webm" src="{{asset('admin/assets/images/background/login-bg.mp4')}}">--}}
                {{--<source type="video/ogg" src="{{asset('admin/assets/images/background/login-bg.mp4')}}">--}}
            {{--</video>--}}

            <div class="login-box card">
                <div class="card-body">
                    <form class="form-horizontal" id="reset_password_form" action="{{route('admin_auth_reset_password_action')}}" method="POST">
                        {{csrf_field()}}
                        <div class="form-group">
                            <div class="col-12 text-center">
                                <h3>Thay đổi mật khẩu</h3>
                                <p class="text-muted">Nhập đầy đủ thông tin để tiến hành thay đổi mật khẩu của bạn!</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="auth_current_password">Mật khẩu hiện tải</label>
                            <input type="password" name="current_password" id="auth_current_password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="auth_new_password">Mật khẩu mới</label>
                            <input type="password" name="new_password" id="auth_new_password" class="form-control" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="auth_new_password_confirmation">Xác nhận mật khẩu mới</label>
                            <input type="password" name="new_password_confirmation" id="auth_new_password_confirmation" class="form-control" autocomplete="off" required>
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Cập nhật mật khẩu</button>
                            </div>
                        </div>
                        <div class="form-group m-b-0">
                            <div class="col-sm-12 text-center">
                                <a href="{{route('admin_dashboard')}}" class="text-dark"><i class="fa fa-backward m-r-5"></i> Quay lại trang quản trị</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
@endsection

@section('admin_css')
    <style>
        .login-box {
            margin: 0 auto 0 25px !important;
        }
    </style>
@endsection

@section('admin_script')
    <script type="text/javascript">
        $(document).ready(function () {

        });
    </script>
@endsection
