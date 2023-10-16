@extends('backend.layouts.main')

@section('content')
    <x-backend.form :data="$data">
        <x-slot:formContent>
            <form id="formData" action="{{ route('backend.'.$routeNameData.'.update',[$routeIdData => $data->id]) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <label>{{ __('name') }}<span class="text-danger">*</span></label>
                        <input type="text" required name="name" class="form-control" value="{{ $data->name }}" placeholder="{{ __('name') }}">
                    </div>
                    <div class="col-md-12 mb-4">
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
        </x-slot>
    </x-backend.form>
@stop
@include("backend.$routeNameData.js")
