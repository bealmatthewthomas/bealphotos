<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class HomepageController
 * @package App\Http\Controllers
 * @author mattbeal
 */
class HomepageController extends Controller
{
    /**
     * @author mattbeal
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('welcome');
    }
}
