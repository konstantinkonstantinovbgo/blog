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
            /*
            ->editColumn('iso', function (Country $country) {
                return $country->cc_iso.'-'.$country->cc_fips;
            })
            */
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
            DB::raw("CONCAT(countries.cc_fips,'-',countries.cc_iso) as iso")
        ];

        $query = Country::query()->select($select);

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
                    ->minifiedAjax('')
                    ->addAction(['width' => '80px'])
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
            ]
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
