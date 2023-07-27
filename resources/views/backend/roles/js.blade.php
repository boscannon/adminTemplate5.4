@push('scripts')
<script>
$(function() {
    var path = '{{ route('backend.'.$routeNameData.'.index') }}';
    var formEdit = $('#formData');

    var permissions = $("#permissions");
    permissions.jstree({ "plugins" : [ "checkbox" ], "core": { "themes": { "icons": false }} });
    formEdit.ajaxForm({
        beforeSubmit: function(arr, $form, options) {
            formEdit.find('button[type=submit]').attr('disabled',true);

            $.each(permissions.jstree("get_selected", true), function() {
                this.data.id && arr.push({
                    name: "permissions[]",
                    value: this.data.id,
                });
            });
        },
        success: function(data) {
            Swal.fire({ text: data.message, icon: 'success' }).then(function() {
                location.href = path;
            });
        },
        complete: function() {
            formEdit.find('button[type=submit]').attr('disabled',false);
        }
    });
});
</script>
@endpush