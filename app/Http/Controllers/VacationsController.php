<?php

namespace App\Http\Controllers;

use App\Vacation;
use Illuminate\Http\Request;

class VacationsController extends Controller
{
    //
    public function index()
    {
        $vacations = Vacation::all();

        $viewdata['models']['vacations'] = $vacations;

        return view('vacations.index', ['viewdata' => $viewdata]);
    }
}
