<div class="block" id="formBlock" style="visibility: hidden;">
    <div class="block-header block-header-default">
        <h3 class="block-title">{{ isset($data) ? __('edit') : __('create') }}</h3>
    </div>
    <div class="block-content block-content-full">
        <div class="block">
            <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
                <li class="nav-item d-md-flex flex-md-column">
                    <button class="nav-link fs-sm text-md-start rounded-0 active" data-bs-toggle="tab" data-bs-target="#btabs-vertical-home" role="tab" aria-controls="btabs-vertical-home" aria-selected="true">
                      <i class="fa fa-fw fa-home opacity-50 me-1 d-none d-sm-inline-block"></i>{{ __('basic_data') }}</a>
                    </button>
                  </li>
                  @isset($data)
                  <li class="nav-item d-md-flex flex-md-column">
                    <button class="nav-link fs-sm text-md-start rounded-0" data-bs-toggle="tab" data-bs-target="#btabs-vertical-audit" role="tab" aria-controls="btabs-vertical-audit" aria-selected="false">
                      <i class="fa fa-fw fa-window-restore opacity-50 me-1 d-none d-sm-inline-block"></i>{{ __('audit') }}</a>
                    </button>
                  </li>
                  @endisset
            </ul>
            <div class="block-content tab-content">
                <div class="tab-pane active" id="btabs-vertical-home" role="tabpanel" aria-labelledby="btabs-vertical-home-tab" tabindex="0">
                    {{ $formContent }}
                </div>
                @isset($data)
                <div class="tab-pane" id="btabs-vertical-audit" role="tabpanel" aria-labelledby="btabs-vertical-audit-tab" tabindex="0">
                    <x-backend.audit :table="$routeNameData" :tableid="$data->id">
                    </x-backend.audit>
                </div>
                @endisset
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(function() {
    setTimeout(() => {
        $("#formBlock").css("visibility", "initial");
    }, 0.1);
});
</script>
@endpush