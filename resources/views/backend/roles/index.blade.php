@extends('backend.layouts.main')

@section('content')
<div class="block">
    <div class="block-header block-header-default">
        <h3 class="block-title">{{ __('list') }}</h3>
        <a href="{{ route('backend.'.$routeNameData.'.create') }}" class="btn btn-primary">{{ __('create') }}</a>
    </div>
    <div class="block-content block-content-full">
        <table class="table table-bordered table-striped table-vcenter js-dataTable-full nowrap" id="data-table" style="width:100%">
            <thead>
            </thead>
        </table>
    </div>
</div>
@stop

@push('scripts')
<script>
$(function() {
    var path = '{{ route('backend.'.$routeNameData.'.index') }}';
    var tableList = $('#data-table');
    var formCreate = $('#form-create');
    var table = tableList.DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        ajax: path,
        order: [[2, 'desc']],
        columns: [
            { data: null, title: '#', bSearchable: false, bSortable: false, render: function ( data, type, row , meta ) {
                return  meta.row + 1;
            }},
            { data: 'name', title: '{{ __("backend.$routeNameData.name") }}' },
            { data: 'created_at', title: '{{ __('created_at') }}' },
            { data: 'updated_at', title: '{{ __('updated_at') }}' },
            { data: 'id', title: '{{ __('option') }}', bSortable: false, render:function(data, type, row) {
                return `
                    <a class="read" href="${ path }/${ data }">{{ __('read') }}</a>
                    ${row.super_admin ? '':
                        `
                            <a class="edit" href="${ path }/${ data }/edit">{{ __('edit') }}</a>
                            <a data-id="${ data }" class="delete" href="javascript:;">{{ __('delete') }}</a>
                        `
                    }
                `;
            }},
        ]
    });

    tableList.on('click','.delete',function(){
        deleteFunc(table, $(this).data('id'), path);
    })
});
</script>
@endpush
