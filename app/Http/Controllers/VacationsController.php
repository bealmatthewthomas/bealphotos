<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVacation;
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

    public function create()
    {
        return view('vacations.create');
    }
    public function store(StoreVacation $request)
    {
        $validated = $request->validated();

        $vacation = new Vacation($request->input('vacation'));

        $vacation_id = $vacation->save();

        return redirect(route('vacation_view', ['vacation_id' => $vacation_id]));
    }

    public function view(int $vacation_id)
    {
        $vacation = Vacation::find($vacation_id);

        $viewdata['models']['vacation'] = $vacation;

        return view('vacations.view', ['viewdata' => $viewdata]);
    }
}
