<?php

namespace App\DataTables;

use App\City;
use Yajra\Datatables\Services\DataTable;


class CitiesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @return \Yajra\Datatables\Engines\BaseEngine
     */
    public function dataTable()
    {
        $request = $this->datatables->getRequest();

        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', 'citiesdatatable.action')
            ->filter(function ($query) use ($request) {

                if ($request->has('search_name')) {
                    $query->where('full_name_nd', 'like', "%{$request->get('search_name')}%");
                }
            });
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = City::query()->select();

        return $this->applyScopes($query);
    }

    public function getBuilderParameters() {
            return [
                'dom'     => 'Bfrtip',
                'order'   => [
                    [0, 'desc']
                ],
                'buttons' => [
                'create',
                'export',
                'print',
                'reset',
                'reload',
            ]
        ];
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        $html = $this->builder()
                    ->columns($this->getColumns())
                    ->addAction(['width' => '80px'])
                    ->parameters($this->getBuilderParameters());

        return $html;
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'cc_fips' => [
                'title' => 'Abbr',
            ],
            'full_name_nd' => [
                'title' => 'Name'
            ],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'citiesdatatable_' . time();
    }
}
