<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\CountriesDataTable;


class CountriesController extends Controller
{
    public function index(CountriesDataTable $dataTable)
    {
        return $dataTable->render('countries');
    }
}
