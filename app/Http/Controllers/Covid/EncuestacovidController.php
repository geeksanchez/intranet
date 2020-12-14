<?php

namespace App\Http\Controllers\Covid;


use App\Http\Controllers\Controller;
use App\Covid;
use App\Employee;
use App\CovidState;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EncuestacovidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('covid.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $covid_state = CovidState::all();
        return view('covid.create', compact('covid_state'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'doctype'       => 'required',
            'document'      => 'required',
            'temperature'   => 'required',
            'close_contact' => 'required',
            'symptom'       => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $employee_id = Employee::where('document', '=', $request->input('document'))
            ->where('doctype', '=', $request->input('doctype'))
            ->value('id');
        if ($employee_id) {
            $input["employee_id"] = $employee_id;
            $input['temperature'] = $request->input('temperature');
            $input['symptoms'] = json_encode($request->input('symptom'));
            $input['close_contact'] = $request->input('close_contact');
            if ((count($request->input('symptom')) == 1) && ($request->input('symptom')[0] == "NINGUNO") && ($request->input('close_contact') == "NO")) {
                $input['covid_state_id'] = 1;
                $covid = Covid::create($input);
                return view('covid.confirmation', compact('covid'));
            } else {
                $input['covid_state_id'] = 2;
                $covid = Covid::create($input);
                return view('covid.warning', compact('covid'));
            }
            
        } else {
            return view('covid.unauthorized');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pqrs  $pqrs
     * @return \Illuminate\Http\Response
     */
    public function show(Pqrs $pqrs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pqrs  $pqrs
     * @return \Illuminate\Http\Response
     */
    public function edit(Pqrs $pqrs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pqrs  $pqrs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pqrs $pqrs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pqrs  $pqrs
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pqrs $pqrs)
    {
        //
    }
}
