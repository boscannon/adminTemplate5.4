@extends('backend.layouts.main')

@section('content')
    <x-backend.form :data="$data">
        <x-slot:formContent>
            <form id="formData" action="{{ route('backend.'.$routeNameData.'.update',[$routeIdData => $data->id]) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <label>{{ __("backend.$routeNameData.name") }}<span class="text-danger">*</span></label>
                        <input type="text" required name="name" class="form-control" value="{{ $data->name }}" placeholder="{{ __("backend.$routeNameData.name") }}">
                    </div>
                    <div class="col-md-12 mb-4">
                        <label>{{ __("backend.$routeNameData.email") }}<span class="text-danger">*</span></label>
                        <input type="email" required name="email" class="form-control"  value="{{ $data->email }}" placeholder="{{ __("backend.$routeNameData.email") }}">
                    </div>
                    <div class="col-md-12 mb-4">
                        <label>{{ __("backend.$routeNameData.roles") }}<span class="text-danger">*</span></label>
                        <select data-ajax--url="{{ route('backend.roles.select') }}" class="js-select2 form-control" required multiple name="roles[]" data-placeholder="{{ __("backend.$routeNameData.roles") }}">
                            @foreach($data->roles as $item)
                                <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                            @endforeach
                            <option></option>
                        </select>
                    </div>
                    <div class="col-md-12 mb-4">
                        <label>{{ __("backend.$routeNameData.password") }}</label>
                        <input type="password" name="password" class="form-control"  value="" placeholder="{{ __("backend.$routeNameData.password") }}">
                    </div>
                    <div class="col-md-12 mb-4">
                        <label>{{ __("backend.$routeNameData.password_confirmation") }}</label>
                        <input type="password" name="password_confirmation" class="form-control" value="" placeholder="{{ __("backend.$routeNameData.password_confirmation") }}">
                    </div>
                    <div class="col-md-6 mb-4">
                        <label>{{ __("backend.$routeNameData.status") }}<span class="text-danger">*</span></label>
                        <div class="col-md-12">
                            <div class="form-check form-switch css-switch">
                                <input class="form-check-input" type="checkbox" {{ $data->status == 1 ? 'checked' : '' }}>
                                <input type="hidden" required name="status" value="{{ $data->status }}">
                                <span class="css-control-indicator"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('backend.'.$routeNameData.'.index') }}" class="btn btn-secondary">{{ __('back') }}</a>
                <button type="submit" class="btn btn-primary">{{ __('edit') }}</button>
            </form>
        </x-slot>
    </x-backend.form>
@stop
@include("backend.$routeNameData.js")
