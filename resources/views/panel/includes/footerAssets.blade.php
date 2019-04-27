
<script src="{{ asset('public/panel/vendor/select2/select2.min.js') }}"></script>


<!-- Custom Theme JavaScript -->
<script src="{{asset('public/panel')}}/dist/js/sb-admin-2.js"></script>


<script>
    $(document).ready(function () {
        $('.select2').select2({
            placeholder: 'Select a Product',
            allowClear: true,
        });
    });

</script>