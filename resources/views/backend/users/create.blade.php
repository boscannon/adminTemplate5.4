@extends('backend.layouts.main')

@section('content')
    @component("backend.components.form")
        @slot('formContent')
            <form id="formData" action="{{ route('backend.'.$routeNameData.'.store') }}" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12 mb-4">
                        <label>{{ __("backend.$routeNameData.name") }}<span class="text-danger">*</span></label>
                        <input type="text" required name="name" class="form-control" placeholder="{{ __("backend.$routeNameData.name") }}">
                    </div>
                    <div class="form-group col-md-12 mb-4">
                        <label>{{ __("backend.$routeNameData.email") }}<span class="text-danger">*</span></label>
                        <input type="email" required name="email" class="form-control" placeholder="{{ __("backend.$routeNameData.email") }}">
                    </div>
                    <div class="form-group col-md-12 mb-4">
                        <label>{{ __("backend.$routeNameData.roles") }}<span class="text-danger">*</span></label>
                        <select data-ajax--url="{{ route('backend.roles.select') }}" class="js-select2 form-control" required multiple name="roles[]" data-placeholder="{{ __("backend.$routeNameData.roles") }}">
                            <option></option>
                        </select>
                    </div>
                    <div class="form-group col-md-12 mb-4">
                        <label>{{ __("backend.$routeNameData.password") }}<span class="text-danger">*</span></label>
                        <input type="password" required name="password" class="form-control"  value="" placeholder="{{ __("backend.$routeNameData.password") }}">
                    </div>
                    <div class="form-group col-md-12 mb-4">
                        <label>{{ __("backend.$routeNameData.password_confirmation") }}<span class="text-danger">*</span></label>
                        <input type="password" required name="password_confirmation" class="form-control" value="" placeholder="{{ __("backend.$routeNameData.password_confirmation") }}">
                    </div>
                    <div class="form-group col-md-6 mb-4">
                        <label>{{ __("backend.$routeNameData.status") }}<span class="text-danger">*</span></label>
                        <div class="col-md-12">
                            <div class="form-check form-switch css-switch">
                                <input class="form-check-input" type="checkbox" checked>
                                <input type="hidden" required name="status" value="1">
                                <span class="css-control-indicator"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('backend.'.$routeNameData.'.index') }}" class="btn btn-secondary">{{ __('back') }}</a>
                <button type="submit" class="btn btn-primary">{{ __('edit') }}</button>
            </form>
        @endslot
    @endcomponent
@stop
@include("backend.$routeNameData.js")