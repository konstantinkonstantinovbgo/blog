@extends('layouts.master')


@section('content')
    {!! $dataTable->table(['class' => 'table table-condensed', 'id' => 'cities-table']) !!}
@endsection

@include('cities.datatables.partials.search_filter')

@push('scripts')
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>

    {!! $dataTable->scripts() !!}

    <script>
        $('#cities-table').on('preXhr.dt', function ( e, settings, data ) {
            data.full_name_nd= $('input[name=full_name_nd]').val();
            data.cc_fips= $('input[name=cc_fips]').val();
            console.log(data);
        });
        /*
        $('#search-form').on('submit', function(e) {
             oTable.draw();
             e.preventDefault();
            alert(123);
        });
        */
    </script>
@endpush
