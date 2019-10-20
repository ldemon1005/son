<script type="text/javascript">
    $(document).ready(function () {
        @if (session('success'))
                console.log('sao nhỉ');
        toastSuccess("{{ session('success') }}");
        @endif

        @if ($errors->any())
        @foreach ($errors->all() as $error)
        toastError("{{ $error }}");
        @endforeach
        @endif
    });
</script>
