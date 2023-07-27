@push('scripts')
<script>
$(function() {
    var path = '{{ route('backend.'.$routeNameData.'.index') }}';
    var formData = $('#formData');
    formData.ajaxForm({
        beforeSubmit: function(arr, $form, options) {
            formData.find('button[type=submit]').attr('disabled',true);
        },
        success: function(data) {
            successFunc(data, path);
        },
        complete: function() {
            formData.find('button[type=submit]').attr('disabled',false);
        }
    });
});
</script>
@endpush