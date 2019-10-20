<script type="text/javascript">
    $(document).ready(function () {
        @if (session('success'))
        toastSuccess("{{ session('success') }}");
        @endif

        @if ($errors->any())
        @foreach ($errors->all() as $error)
        toastError("{{ $error }}");
        @endforeach
        @endif

        $('.btn__logout').click(function (e) {
            alertWarning(function () {
                return window.location.href = "{{route('admin_auth_logout')}}";
            }, "Bạn muốn đăng xuất?");
        });
    });
</script>
