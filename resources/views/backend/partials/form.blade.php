<div class="block">
    <div class="block-header block-header-default">
        <h3 class="block-title">{{ __('edit') }}</h3>
    </div>
    <div class="block-content block-content-full">
        <div class="block">
            <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
                <li class="nav-item d-md-flex flex-md-column">
                    <button class="nav-link fs-sm text-md-start rounded-0 active" data-bs-toggle="tab" data-bs-target="#btabs-vertical-home" role="tab" aria-controls="btabs-vertical-home" aria-selected="true">
                      <i class="fa fa-fw fa-home opacity-50 me-1 d-none d-sm-inline-block"></i>{{ __('basic_data') }}</a>
                    </button>
                  </li>
                  @isset($edit)
                  <li class="nav-item d-md-flex flex-md-column">
                    <button class="nav-link fs-sm text-md-start rounded-0" data-bs-toggle="tab" data-bs-target="#btabs-vertical-audit" role="tab" aria-controls="btabs-vertical-audit" aria-selected="false">
                      <i class="fa fa-fw fa-user-circle opacity-50 me-1 d-none d-sm-inline-block"></i>{{ __('audit') }}</a>
                    </button>
                  </li>
                  @endisset
            </ul>
            <div class="block-content tab-content">
                <div class="tab-pane active" id="btabs-vertical-home" role="tabpanel" aria-labelledby="btabs-vertical-home-tab" tabindex="0">
                    {{ $formContent }}
                </div>
                @isset($edit)
                <div class="tab-pane" id="btabs-vertical-audit" role="tabpanel" aria-labelledby="btabs-vertical-audit-tab" tabindex="0">
                    @include('backend.partials.audits', [ 'table' => $routeNameData, 'table_id' => $data->id ])
                </div>
                @endisset
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(function() {
    var path = '{{ route('backend.'.$routeNameData.'.index') }}';
    var formEdit = $('#form-edit');

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