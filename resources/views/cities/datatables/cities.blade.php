@extends('layouts.master')


@section('content')
    {!! $dataTable->table() !!}
@endsection

@include('cities.datatables.partials.search_filter')

@push('scripts')
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>

    {!! $dataTable->scripts() !!}

    <script>
        $('#dataTableBuilder').on('preXhr.dt', function ( e, settings, data ) {
            data.full_name_nd= $('input[name=search_name]').val();
            console.log(data);
        });

        $('#search-form').on('submit', function(e) {
             // oTable.draw();
             window.LaravelDataTables["dataTableBuilder"].draw();
             e.preventDefault();
        });
    </script>
@endpush
