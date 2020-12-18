<?php

namespace App\Http\Controllers\Covid;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class CovidRelatedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

}
