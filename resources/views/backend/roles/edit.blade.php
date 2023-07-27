@extends('backend.layouts.main')

@section('content')
    @component("backend.components.form", ['data' => $data, 'edit' => true])
        @slot('formContent')
            <form id="formData" action="{{ route('backend.'.$routeNameData.'.update',[$routeIdData => $data->id]) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="form-group col-md-12 mb-4">
                        <label>{{ __('name') }}<span class="text-danger">*</span></label>
                        <input type="text" required name="name" class="form-control" value="{{ $data->name }}" placeholder="{{ __('name') }}">
                    </div>
                    <div class="form-group col-md-12 mb-4">
                        <label>{{ __("backend.$routeNameData.permissions") }}</label>
                        <div class="ml-2 form-group">
                            <div id="permissions" class="demo">
                                @include('backend.roles.partials.child', [ 'menu' => config('menu'), 'actions' => $actions, 'data' => $data ])
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
