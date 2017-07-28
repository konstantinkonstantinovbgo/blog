<?php

namespace App\DataTables;

use App\Country;
use Yajra\Datatables\Services\DataTable;
use DB;


class CountriesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @return \Yajra\Datatables\Engines\BaseEngine
     */
    public function dataTable()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->filterColumn('iso', function($query, $keyword) {
                $sql = "CONCAT(countries.cc_fips,' ',countries.cc_iso)  like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->addColumn('action', 'countriesdatatable.action');
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $select = [
            'country_name',
            'tld',
            DB::raw("CONCAT(countries.cc_fips,'-',countries.cc_iso) as iso"),
            DB::raw('count(world_cities_free.cc_fips) as count')
        ];

        $query = Country::query()
            ->select($select)
            ->leftJoin('world_cities_free','world_cities_free.cc_fips','=','countries.cc_fips')
            ->groupBy('countries.cc_fips');

        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    // ->minifiedAjax('')
                    ->addColumn(['data' => 'count','name' => 'count', 'title' => '# of Cities', 'searchable' => false])
                    ->addAction(['width' => '80px', 'orderable' => false, 'searchable' => false])
                    ->parameters([
                        'dom'     => 'Bfrtip',
                        'order'   => [[0, 'desc']],
                        'buttons' => [
                            'create',
                            'export',
                            'print',
                            'reset',
                            'reload',
                        ],
                        /* footer column search */
                        'initComplete' => "function () {
                            this.api().columns().every(function () {
                                var column = this;
                                var input = document.createElement(\"input\");
                                $(input).appendTo($(column.footer()).empty())
                                .on('change', function () {
                                    column.search($(this).val(), false, false, true).draw();
                                });
                            });
                        }",
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'country_name' => [
                'title' => 'Country'
            ],
            'tld' => [
                'title' => 'TLD'
            ],
            'iso' => [
                'title' => 'ISO'
            ],
            /*
            'count' => [
                'title' => '# of Cities'
            ]
            */
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'countriesdatatable_' . time();
    }
}
