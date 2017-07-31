<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\CitiesDataTable;


class CitiesController extends Controller
{
    public function index(CitiesDataTable $dataTable)
    {
        return $dataTable->render('cities/cities');
    }
}
