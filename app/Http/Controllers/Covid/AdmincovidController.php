<?php

namespace App\Http\Controllers\Covid;


use App\Http\Controllers\Controller;
use App\Covid;
use App\Employee;
use App\CovidFollow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\CovidExport;
use Maatwebsite\Excel\Facades\Excel;

class AdmincovidController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $covid = DB::table('covid')
            ->join('employee', 'employee_id', '=', 'employee.id')
            ->select('covid.*', 'employee.fullname', 'employee.doctype', 'employee.document', 'employee.phone')
            ->where('covid.covid_state_id', '<>', '1')
            ->orderBy('covid.id', 'desc')
            ->paginate(15);
        # dd($covid);
        return view('covid.admin.index', compact('covid'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $covid = Covid::findOrFail($id);
        return view('covid.admin.show', compact('covid'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = auth()->user()->id;
        $covid = Covid::findOrFail($id);
        $employee = Employee::findOrFail($covid->employee_id);
        $age = now()->diff($employee->birthdate);
        $employee['age'] = $age->y;
        $covid_follow = CovidFollow::where('covid_id', '=', $covid->id);
        //if (!$covid_follow) {
            $covid_follow['notes'] = '';
        //}
        $other_covid = DB::table('covid')
            ->where('employee_id', '=', $covid->employee_id)
            ->where('covid_state_id', '<>', '1')
            ->where('covid.id', '<>', $covid->id)
            ->join('covid_state', 'covid_state_id', '=', 'covid_state.id')
            ->select('covid.*', 'covid_state.name')
            ->orderBy('covid.id', 'DESC')
            ->get();
        return view('covid.admin.edit', compact('user', 'covid', 'covid_follow', 'other_covid', 'employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $covid = Covid::findOrFail($id);
        if ($request->cerrar) {
            $covid->covid_state_id = 1;
        }
        $covid->user_id = auth()->user()->id;
        $covid->notes = $request->notes;
        $covid->save();
        return redirect('admincovid');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Covid $covid)
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return CSV file
     */
    public function export()
    {
        return Excel::download(new CovidExport, 'covid.csv', \Maatwebsite\Excel\Excel::CSV, [
            'Content-Type' => 'text/csv',
        ]);
    }
}
