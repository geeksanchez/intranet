<?php

namespace App\Http\Controllers\Farmacoseguridad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Seguimiento;
use App\Exports\SeguimientosExport;
use Maatwebsite\Excel\Facades\Excel;

class FarmacoseguridadController extends Controller
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
        $seguimientos = Seguimiento::where('active', '=', '1')
            ->orderBy('id', 'desc')
            ->paginate(5);
        return view('farmacoseguridad.index', compact('seguimientos'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $seguimiento = Seguimiento::findOrFail($id);
        $seguimiento->active = '0';
        $seguimiento->user_id = auth()->user()->id;
        $seguimiento->save();
        return redirect('farmacoseguridad');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect('farmacoseguridad');
    }

    /**
     * Display a listing of the resource.
     *
     * @return CSV file
     */
    public function export()
    {
        return Excel::download(new SeguimientosExport, 'seguimientos.csv', \Maatwebsite\Excel\Excel::CSV, [
            'Content-Type' => 'text/csv',
        ]);
    }
}
