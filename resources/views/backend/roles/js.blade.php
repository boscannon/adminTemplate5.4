@push('scripts')
<script>
$(function() {
    var path = '{{ route('backend.'.$routeNameData.'.index') }}';
    var formData = $('#formData');

    var permissions = $("#permissions");
    permissions.jstree({ "plugins" : [ "checkbox" ], "core": { "themes": { "icons": false }} });
    formData.ajaxForm({
        beforeSubmit: function(arr, $form, options) {
            formData.find('button[type=submit]').attr('disabled',true);

            $.each(permissions.jstree("get_selected", true), function() {
                this.data.id && arr.push({
                    name: "permissions[]",
                    value: this.data.id,
                });
            });
            
            swal.fire({
                showCancelButton: false,
                showConfirmButton: false,
                allowOutsideClick: false,
                title: 'Loading...',
                icon: 'warning',
            });            
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