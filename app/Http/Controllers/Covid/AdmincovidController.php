<?php

namespace App\Http\Controllers\Covid;


use App\Http\Controllers\Controller;
use App\Covid;
use App\Employee;
use App\CovidFollow;
use App\CovidPositive;
use App\CovidRelated;
use App\CovidSample;
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
            $samples = CovidSample::where('covid_id', '=', $id)->get();
            $covid_follow = CovidFollow::where('covid_id', '=', $covid->id)->first();
            $covid_related = DB::select(DB::raw
                ("SELECT t3.* FROM 
                    (SELECT t2.id, t2.employee_id, t2.doctype, t2.document, t2.fullname, covid_state.name, t2.created_at FROM 
                    (SELECT t1.employee_id, t1.doctype, t1.document, t1.fullname, covid.covid_state_id, covid.created_at, covid.id FROM 
                        (SELECT covid_related.employee_id AS employee_id, employee.doctype AS doctype, employee.document AS document, employee.fullname AS fullname FROM covid_related 
                                INNER JOIN employee ON covid_related.employee_id = employee.id WHERE covid_related.covid_id = $covid->id) AS t1, covid 
                    WHERE covid.employee_id = t1.employee_id) AS t2, covid_state
                    WHERE covid_state.id = t2.covid_state_id) AS t3,
                    (SELECT covid.* FROM 
                        (SELECT covid.*, MAX(created_at) AS max_date FROM covid GROUP BY covid.employee_id) AS p1, covid
                    WHERE covid.created_at = p1.max_date) AS t4
                WHERE t3.id = t4.id"));
            return view('covid.admin.show-pending', compact('covid', 'covid_follow', 'employee', 'covid_related', 'samples'));
        } elseif ($covid->covid_state_id == 5) {
            $employee = Employee::findOrFail($covid->employee_id);
            $age = now()->diff($employee->birthdate);
            $employee['age'] = $age->y;
            $samples = CovidSample::where('covid_id', '=', $id)->get();
            $covid_follow = CovidFollow::where('covid_id', '=', $covid->id)->first();
            $covid_positive = CovidPositive::where('covid_id', '=', $covid->id)->first();
            $covid_related = DB::select(DB::raw
                ("SELECT t3.* FROM 
                    (SELECT t2.id, t2.employee_id, t2.doctype, t2.document, t2.fullname, covid_state.name, t2.created_at FROM 
                    (SELECT t1.employee_id, t1.doctype, t1.document, t1.fullname, covid.covid_state_id, covid.created_at, covid.id FROM 
                        (SELECT covid_related.employee_id AS employee_id, employee.doctype AS doctype, employee.document AS document, employee.fullname AS fullname FROM covid_related 
                                INNER JOIN employee ON covid_related.employee_id = employee.id WHERE covid_related.covid_id = $covid->id) AS t1, covid 
                    WHERE covid.employee_id = t1.employee_id) AS t2, covid_state
                    WHERE covid_state.id = t2.covid_state_id) AS t3,
                    (SELECT covid.* FROM 
                        (SELECT covid.*, MAX(created_at) AS max_date FROM covid GROUP BY covid.employee_id) AS p1, covid
                    WHERE covid.created_at = p1.max_date) AS t4
                WHERE t3.id = t4.id"));
            return view('covid.admin.show-confirmed', compact('covid', 'covid_positive', 'covid_follow', 'employee', 'covid_related', 'samples'));
        }
        return back()->withInput();

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
            $samples = CovidSample::where('covid_id', '=', $id)
                ->orderBy('sample_date', 'DESC')
                ->get();
            $other_covid = DB::table('covid')
                ->where('employee_id', '=', $covid->employee_id)
                ->where('covid_state_id', '>', '1')
                ->where('covid.id', '<>', $covid->id)
                ->join('covid_state', 'covid_state_id', '=', 'covid_state.id')
                ->select('covid.*', 'covid_state.name')
                ->orderBy('covid.id', 'DESC')
                ->get();
            $covid_related = DB::select(DB::raw
                ("SELECT t3.* FROM 
                    (SELECT t2.id, t2.employee_id, t2.doctype, t2.document, t2.fullname, covid_state.name, t2.created_at FROM 
                    (SELECT t1.employee_id, t1.doctype, t1.document, t1.fullname, covid.covid_state_id, covid.created_at, covid.id FROM 
                        (SELECT covid_related.employee_id AS employee_id, employee.doctype AS doctype, employee.document AS document, employee.fullname AS fullname FROM covid_related 
                                INNER JOIN employee ON covid_related.employee_id = employee.id WHERE covid_related.covid_id = $covid->id) AS t1, covid 
                    WHERE covid.employee_id = t1.employee_id) AS t2, covid_state
                    WHERE covid_state.id = t2.covid_state_id) AS t3,
                    (SELECT covid.* FROM 
                        (SELECT covid.*, MAX(created_at) AS max_date FROM covid GROUP BY covid.employee_id) AS p1, covid
                    WHERE covid.created_at = p1.max_date) AS t4
                WHERE t3.id = t4.id"));
            return view('covid.admin.edit-pending', compact('covid', 'covid_follow', 'other_covid', 'employee', 'covid_related', 'samples'));
        } elseif ($covid->covid_state_id == 3) {
            $employee = Employee::findOrFail($covid->employee_id);
            $age = now()->diff($employee->birthdate);
            $employee['age'] = $age->y;
            $covid_follow = CovidFollow::where('covid_id', '=', $covid->id)->first();
            $covid_positive = CovidPositive::firstOrCreate(['covid_id' => $covid->id]);
            $samples = CovidSample::where('covid_id', '=', $id)->get();
            $other_covid = DB::table('covid')
                ->where('employee_id', '=', $covid->employee_id)
                ->where('covid_state_id', '>', '1')
                ->where('covid.id', '<>', $covid->id)
                ->join('covid_state', 'covid_state_id', '=', 'covid_state.id')
                ->select('covid.*', 'covid_state.name')
                ->orderBy('covid.id', 'DESC')
                ->get();
            $covid_related = DB::select(DB::raw
                ("SELECT t3.* FROM 
                    (SELECT t2.id, t2.employee_id, t2.doctype, t2.document, t2.fullname, covid_state.name, t2.created_at FROM 
                    (SELECT t1.employee_id, t1.doctype, t1.document, t1.fullname, covid.covid_state_id, covid.created_at, covid.id FROM 
                        (SELECT covid_related.employee_id AS employee_id, employee.doctype AS doctype, employee.document AS document, employee.fullname AS fullname FROM covid_related 
                                INNER JOIN employee ON covid_related.employee_id = employee.id WHERE covid_related.covid_id = $covid->id) AS t1, covid 
                    WHERE covid.employee_id = t1.employee_id) AS t2, covid_state
                    WHERE covid_state.id = t2.covid_state_id) AS t3,
                    (SELECT covid.* FROM 
                        (SELECT covid.*, MAX(created_at) AS max_date FROM covid GROUP BY covid.employee_id) AS p1, covid
                    WHERE covid.created_at = p1.max_date) AS t4
                WHERE t3.id = t4.id"));
            return view('covid.admin.edit-confirmed', compact('covid', 'covid_positive', 'covid_follow', 'other_covid', 'employee', 'covid_related', 'samples'));
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

    public function related($covid_id)
    {
        if (! Gate::allows('covid_manage')) {
            return abort(401);
        }
        $covid = Covid::where('covid.id', '=', $covid_id)
            ->join('employee', 'covid.employee_id', '=', 'employee.id')
            ->select('covid.*', 'employee.fullname')
            ->first();
        $covidrelated = CovidRelated::where('covid_id', '=', $covid_id)
            ->join('employee', 'employee_id', '=', 'employee.id')
            ->select('employee.fullname')
            ->get();
        $employee = Employee::orderBy('fullname', 'ASC')->get();
        return view('covid.admin.edit-related', compact('covid', 'covidrelated', 'employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updaterelated(Request $request, $covid_id)
    {
        if (! Gate::allows('covid_manage')) {
            return abort(401);
        }

        $covid = Covid::find($covid_id);

        $input["covid_id"] = $covid_id;
        $input["employee_id"] = $request->employee;

        if (($covid->employee_id != $input["employee_id"]) && ($input["employee_id"] != NULL)) {
            $covidrelated = CovidRelated::firstOrCreate($input);
            $covidReport = Covid::where('employee_id', '=', $input["employee_id"])
                ->whereIn('covid_state_id', [2, 3])
                ->get();
            if ($covidReport->isEmpty()) {
                $newcovid = new Covid;
                $newcovid->employee_id = $input["employee_id"];
                $newcovid->worktype = 'OFICINA';
                $newcovid->temperature = 36;
                $newcovid->close_contact = 'SI';
                $newcovid->covid_state_id = 2;
                $newcovid->symptoms = json_encode(array('CONTACTO ESTRECHO ' . $covid_id));
                $newcovid->save();
            };
        }

        $covid = Covid::where('covid.id', '=', $covid_id)
            ->join('employee', 'covid.employee_id', '=', 'employee.id')
            ->select('covid.*', 'employee.fullname')
            ->first();
        $covidrelated = CovidRelated::where('covid_id', '=', $covid_id)
            ->join('employee', 'employee_id', '=', 'employee.id')
            ->select('employee.fullname')
            ->get();
        $employee = Employee::orderBy('fullname', 'ASC')->get();
        return view('covid.admin.edit-related', compact('covid', 'covidrelated', 'employee'));
    }

    public function sample($covid_id)
    {
        if (! Gate::allows('covid_manage')) {
            return abort(401);
        }
        $covid = Covid::find($covid_id);
        $employee = Employee::find($covid->employee_id);
        return view('covid.admin.create-sample', compact('covid', 'employee'));
    }

    public function updatesample(Request $request, $covid_id)
    {
        if (! Gate::allows('covid_manage')) {
            return abort(401);
        }
        $sample = new CovidSample;
        $sample->covid_id = $covid_id;
        $sample->sample_date = $request->sample_date;
        $sample->result = $request->sample_result;
        $sample->save();
        return redirect()->route('admincovid.edit', $covid_id);
    }
    
}
