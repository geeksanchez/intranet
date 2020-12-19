<?php

namespace App\Http\Controllers\Covid;

use App\Http\Controllers\Controller;
use App\Covid;
use App\CovidRelated;
use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class CovidRelatedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function related($covid_id)
    {
        if (! Gate::allows('covid_manage')) {
            return abort(401);
        }
        $covid = Covid::get($covid_id);
        $covidrelated = CovidRelated::where('covid_id', '=', $covid_id)
            ->join('employee', 'employee_id', '=', 'employee.id')
            ->select('employee.fullname')
            ->get();
        $employee = Employee::all();
        return view('covid.admin.show-related', compact('covidrelated', 'employee'));
    }

}
