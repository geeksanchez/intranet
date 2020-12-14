<?php

namespace App\Http\Controllers\Pqrs;


use App\Http\Controllers\Controller;
use App\Pqrs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PqrsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pqrs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pqrs.create');
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
            'username'      => 'required',
            'email'         => 'required',
            'cellphone'     => 'required',
            'insurer'       => 'required',
            'branch'        => 'required',
            'service'       => 'required',
            'classification'=> 'required',
            'filledby'      => 'required',
            'legal'         => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $input = $request->all();

        $pqrs = Pqrs::create($input);

        return view('pqrs.confirmation', compact('pqrs'));
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
