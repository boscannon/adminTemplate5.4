@extends('backend.layouts.main')

@section('content')
<div class="block">
    <div class="block-header block-header-default">
        <h3 class="block-title">{{ __('edit') }}</h3>
    </div>
    <div class="block-content block-content-full">
        <form id="form-edit" action="{{ route('backend.'.$routeNameData.'.update',[$routeIdData => $data->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="block">
                <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#btabs-static-home">{{ __('basic_data') }}</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#btabs-static-profile">{{ __('audit') }}</a>
                    </li> -->
                </ul>
                <div class="block-content tab-content">
                    <div class="tab-pane active" id="btabs-static-home" role="tabpanel">
                        <div class="form-row">
                            <div class="form-group col-md-12 mb-4">
                                <label>{{ __("backend.$routeNameData.name") }}<span class="text-danger">*</span></label>
                                <input type="text" required name="name" class="form-control" value="{{ $data->name }}" placeholder="{{ __("backend.$routeNameData.name") }}">
                            </div>     
                            <div class="form-group col-md-12 mb-4">
                                <label>{{ __("backend.$routeNameData.images") }}</label>    
                                <fieldset class="image">
                                    @foreach($data->getMedia('images') as $value)
                                    <input value="{{ $value->getFullUrl() }}" checked type="checkbox" />{{ $value->getFullUrl() }}
                                    @endforeach
                                    <input type="file" name="images[]" data-allow-reorder="true" multiple accept="image/*" />    
                                </fieldset>  
                            </div>                                                
                        </div>
                    </div>
                    <div class="tab-pane" id="btabs-static-profile" role="tabpanel">
                        @include('backend.partials.audits', [ 'table' => $routeNameData, 'table_id' => $data->id ])
                    </div>
                </div>
            </div>
            <a href="{{ route('backend.'.$routeNameData.'.index') }}" class="btn btn-secondary">{{ __('back') }}</a>
            <button type="submit" class="btn btn-primary">{{ __('edit') }}</button>
        </form>
    </div>
</div>
@stop

@push('scripts')
<script>
$(function() {
    var path = '{{ route('backend.'.$routeNameData.'.index') }}';
    var formEdit = $('#form-edit');
    document.querySelectorAll('fieldset.image').forEach(item => FilePond.create(item))
    formEdit.ajaxForm({
        beforeSubmit: function(arr, $form, options) {    
            formEdit.find('button[type=submit]').attr('disabled',true);
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
