<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\MasterAndDetailDataTable;


class MasterAndDetailController extends Controller
{
    public function index(MasterAndDetailDataTable $dataTable)
    {
        return $dataTable->render('masteranddetail');
    }

    public function details($id)
    {
        dd($id);
    }
}
