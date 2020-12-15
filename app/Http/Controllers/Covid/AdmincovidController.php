<?php

namespace App\Http\Controllers\Covid;


use App\Http\Controllers\Controller;
use App\Covid;
use App\Employee;
use App\CovidFollow;
use App\CovidPositive;
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
        $covid = Covid::findOrFail($id);
        if ($covid->covid_state_id == 4) {
            $employee = Employee::findOrFail($covid->employee_id);
            $age = now()->diff($employee->birthdate);
            $employee['age'] = $age->y;
            $covid_follow = CovidFollow::where('covid_id', '=', $covid->id)->first();
            return view('covid.admin.show-pending', compact('covid', 'covid_follow', 'employee'));
        } elseif ($covid->covid_state_id == 5) {
            $employee = Employee::findOrFail($covid->employee_id);
            $age = now()->diff($employee->birthdate);
            $employee['age'] = $age->y;
            $covid_follow = CovidFollow::where('covid_id', '=', $covid->id)->first();
            $covid_positive = CovidPositive::where('covid_id', '=', $covid->id)->first();
            return view('covid.admin.show-confirmed', compact('covid', 'covid_positive', 'covid_follow', 'employee'));
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
            return view('covid.admin.edit-pending', compact('covid', 'covid_follow', 'other_covid', 'employee'));
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
            return view('covid.admin.edit-confirmed', compact('covid', 'covid_positive', 'covid_follow', 'other_covid', 'employee'));
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
                    $covid_follow->notes = $request->notes . PHP_EOL . "Cierra caso";
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
                $covid_follow->return_date = (new \DateTime())->format('Y-m-d H:i:s');
                $covid = Covid::findOrFail($covid_positive->covid_id);
                $covid->covid_state_id = 5;
                $covid->save();
            }

            $covid_follow->save();
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
        return Excel::download(new CovidExport, 'covid.csv', \Maatwebsite\Excel\Excel::CSV, [
            'Content-Type' => 'text/csv',
        ]);
    }
}
