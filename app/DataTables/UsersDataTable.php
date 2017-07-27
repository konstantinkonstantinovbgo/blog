<?php

namespace App\DataTables;

use App\User;
use Yajra\Datatables\Services\DataTable;
use Collective\Html\HtmlFacade;

class UsersDataTable extends DataTable
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
            // ->addColumn('action', 'usersdatatable.action')
            ->editColumn('email', 'Email: {{$email}}') // Add Column with Blade Syntax
            ->editColumn('name', function(User $user) { //Add Column with Closure
                return 'Hi ' . $user->name . '!';
            })
            ->editColumn('remember_token', 'users.datatables.partials.remember_token') // Add Column with View
            ->editColumn('action', function(User $user) {
                return view('users.datatables.partials.action', compact('user'));
            })
            ->rawColumns(['remember_token', 'updated_at','action']);
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = User::query()->select($this->getColumns());

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
                    ->addAction(['width' => '120px'])
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
            'id',
            'name',
            'email',
            'remember_token',
            'created_at',
            'updated_at'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'usersdatatable_' . time();
    }
}
