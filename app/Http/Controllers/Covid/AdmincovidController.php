<?php

namespace App\Http\Controllers\Covid;


use App\Http\Controllers\Controller;
use App\Covid;
use App\Employee;
use App\CovidFollow;
use App\CovidPositive;
use App\CovidRelated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
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
        if (! Gate::allows('covid_manage')) {
            return abort(401);
        }
        
        $covid = DB::table('covid')
            ->join('employee', 'employee_id', '=', 'employee.id')
            ->select('covid.*', 'employee.fullname', 'employee.doctype', 'employee.document', 'employee.phone')
            ->where('covid.covid_state_id', '>', '1')
            ->where('covid.covid_state_id', '<', '4')
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
        if (! Gate::allows('covid_manage')) {
            return abort(401);
        }

        $covid = Covid::findOrFail($id);
        if ($covid->covid_state_id == 4) {
            $employee = Employee::findOrFail($covid->employee_id);
            $age = now()->diff($employee->birthdate);
            $employee['age'] = $age->y;
            $covid_follow = CovidFollow::where('covid_id', '=', $covid->id)->first();
            $covid_related = DB::select(DB::raw
                ("SELECT t2.doctype, t2.document, t2.fullname, covid_state.name, t2.created_at FROM 
                (SELECT t1.doctype, t1.document, t1.fullname, covid.covid_state_id, covid.created_at FROM 
                (SELECT covid_related.employee_id AS employee_id, employee.doctype AS doctype, employee.document AS document, employee.fullname AS fullname FROM 
                covid_related INNER JOIN employee ON covid_related.employee_id = employee.id 
                WHERE covid_related.covid_id = $covid->id) AS t1, covid 
                WHERE covid.employee_id = t1.employee_id) AS t2, covid_state 
                WHERE covid_state.id = t2.covid_state_id ORDER BY t2.created_at DESC LIMIT 1"));
            return view('covid.admin.show-pending', compact('covid', 'covid_follow', 'employee', 'covid_related'));
        } elseif ($covid->covid_state_id == 5) {
            $employee = Employee::findOrFail($covid->employee_id);
            $age = now()->diff($employee->birthdate);
            $employee['age'] = $age->y;
            $covid_follow = CovidFollow::where('covid_id', '=', $covid->id)->first();
            $covid_positive = CovidPositive::where('covid_id', '=', $covid->id)->first();
            $covid_related = DB::select(DB::raw
                ("SELECT t2.doctype, t2.document, t2.fullname, covid_state.name, t2.created_at FROM 
                (SELECT t1.doctype, t1.document, t1.fullname, covid.covid_state_id, covid.created_at FROM 
                (SELECT covid_related.employee_id AS employee_id, employee.doctype AS doctype, employee.document AS document, employee.fullname AS fullname FROM 
                covid_related INNER JOIN employee ON covid_related.employee_id = employee.id 
                WHERE covid_related.covid_id = $covid->id) AS t1, covid 
                WHERE covid.employee_id = t1.employee_id) AS t2, covid_state 
                WHERE covid_state.id = t2.covid_state_id ORDER BY t2.created_at DESC LIMIT 1"));
            return view('covid.admin.show-confirmed', compact('covid', 'covid_positive', 'covid_follow', 'employee', 'covid_related'));
        }
        return view('covid.admin.index');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('covid_manage')) {
            return abort(401);
        }

        $covid = Covid::findOrFail($id);
        if ($covid->covid_state_id == 2) {
            $employee = Employee::findOrFail($covid->employee_id);
            $age = now()->diff($employee->birthdate);
            $employee['age'] = $age->y;
            $covid_follow = CovidFollow::firstOrCreate(['covid_id' => $covid->id]);
            $other_covid = DB::table('covid')
                ->where('employee_id', '=', $covid->employee_id)
                ->where('covid_state_id', '>', '1')
                ->where('covid.id', '<>', $covid->id)
                ->join('covid_state', 'covid_state_id', '=', 'covid_state.id')
                ->select('covid.*', 'covid_state.name')
                ->orderBy('covid.id', 'DESC')
                ->get();
            $covid_related = DB::select(DB::raw
                ("SELECT t2.doctype, t2.document, t2.fullname, covid_state.name, t2.created_at FROM 
                (SELECT t1.doctype, t1.document, t1.fullname, covid.covid_state_id, covid.created_at FROM 
                (SELECT covid_related.employee_id AS employee_id, employee.doctype AS doctype, employee.document AS document, employee.fullname AS fullname FROM 
                covid_related INNER JOIN employee ON covid_related.employee_id = employee.id 
                WHERE covid_related.covid_id = $covid->id) AS t1, covid 
                WHERE covid.employee_id = t1.employee_id) AS t2, covid_state 
                WHERE covid_state.id = t2.covid_state_id ORDER BY t2.created_at DESC LIMIT 1"));
            return view('covid.admin.edit-pending', compact('covid', 'covid_follow', 'other_covid', 'employee', 'covid_related'));
        } elseif ($covid->covid_state_id == 3) {
            $employee = Employee::findOrFail($covid->employee_id);
            $age = now()->diff($employee->birthdate);
            $employee['age'] = $age->y;
            $covid_follow = CovidFollow::where('covid_id', '=', $covid->id)->first();
            $covid_positive = CovidPositive::firstOrCreate(['covid_id' => $covid->id]);
            $other_covid = DB::table('covid')
                ->where('employee_id', '=', $covid->employee_id)
                ->where('covid_state_id', '>', '1')
                ->where('covid.id', '<>', $covid->id)
                ->join('covid_state', 'covid_state_id', '=', 'covid_state.id')
                ->select('covid.*', 'covid_state.name')
                ->orderBy('covid.id', 'DESC')
                ->get();
            $covid_related = DB::select(DB::raw
                ("SELECT t2.doctype, t2.document, t2.fullname, covid_state.name, t2.created_at FROM 
                (SELECT t1.doctype, t1.document, t1.fullname, covid.covid_state_id, covid.created_at FROM 
                (SELECT covid_related.employee_id AS employee_id, employee.doctype AS doctype, employee.document AS document, employee.fullname AS fullname FROM 
                covid_related INNER JOIN employee ON covid_related.employee_id = employee.id 
                WHERE covid_related.covid_id = $covid->id) AS t1, covid 
                WHERE covid.employee_id = t1.employee_id) AS t2, covid_state 
                WHERE covid_state.id = t2.covid_state_id ORDER BY t2.created_at DESC LIMIT 1"));
            return view('covid.admin.edit-confirmed', compact('covid', 'covid_positive', 'covid_follow', 'other_covid', 'employee', 'covid_related'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (! Gate::allows('covid_manage')) {
            return abort(401);
        }

        if ($request->state == "2") {
            $covid_follow = CovidFollow::findOrFail($id);

            $user = Employee::findOrFail(auth()->user()->id);

            $covid_follow->disability = $request->disability;
            $covid_follow->disability_date = $request->disability_date;
            $covid_follow->return_date = $request->return_date;
            $covid_follow->diagnosis = $request->diagnosis;

            $covid_follow->notes = $request->notes . PHP_EOL . $user->fullname . PHP_EOL .
                (new \DateTime())->format('Y-m-d H:i:s') . PHP_EOL . $request->follow;

                if ($request->covid_positivo || $request->cerrar) {
                $covid = Covid::findOrFail($covid_follow->covid_id);
                if ($request->covid_positivo) {
                    $covid->covid_state_id = 3;
                } elseif ($request->cerrar) {
                    $covid_follow->notes = $covid_follow->notes . PHP_EOL . "Cierra caso";
                    $covid->covid_state_id = 4;
                }
                $covid->save();
            }

            $covid_follow->save();
        } elseif ($request->state == "3") {
            $covid_positive = CovidPositive::findOrFail($id);

            $user = Employee::findOrFail(auth()->user()->id);

            $covid_positive->contact_type = $request->contact_type;
            $covid_positive->description = $request->description;
            $covid_positive->symptoms = $request->symptoms;
            $covid_positive->treatment = $request->treatment;

            $covid_positive->notes = $covid_positive->notes . PHP_EOL . $user->fullname . PHP_EOL .
                (new \DateTime())->format('Y-m-d H:i:s') . PHP_EOL . $request->follow;

                if ($request->cerrar) {
                $covid_positive->notes = $covid_positive->notes . PHP_EOL . "Cierra caso";
                $covid_follow = CovidFollow::where('covid_id', '=', $covid_positive->covid_id)->first();
                if ($covid_follow->return_date == NULL) {
                    $covid_follow->return_date = (new \DateTime())->format('Y-m-d H:i:s');
                    $covid_follow->save();
                }
                $covid = Covid::findOrFail($covid_positive->covid_id);
                $covid->covid_state_id = 5;
                $covid->save();
            }

            $covid_positive->save();
        }
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
        if (! Gate::allows('covid_manage')) {
            return abort(401);
        }

        return Excel::download(new CovidExport, 'covid.csv', \Maatwebsite\Excel\Excel::CSV, [
            'Content-Type' => 'text/csv',
        ]);
    }
}
