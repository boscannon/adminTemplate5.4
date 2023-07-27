@extends('backend.layouts.main')

@section('content')
    <x-backend.form>
        <x-slot:formContent>
            <form id="formData" action="{{ route('backend.'.$routeNameData.'.store') }}" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12 mb-4">
                        <label>{{ __('name') }}<span class="text-danger">*</span></label>
                        <input type="text" required name="name" class="form-control" placeholder='{{ __("backend.$routeNameData.name") }}'>
                    </div>
                    <div class="form-group col-md-12 mb-4">
                        <label>{{ __("backend.$routeNameData.permissions") }}</label>
                        <div class="ml-2 form-group">
                            <div id="permissions" class="demo">
                                @include('backend.roles.partials.child', [ 'menu' => config('menu'), 'actions' => $actions, 'data' => null ])
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
