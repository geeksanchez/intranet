<?php

namespace App\Http\Controllers\Pqrs;


use App\Http\Controllers\Controller;
use App\Pqrs;
use Illuminate\Http\Request;
use App\Exports\PqrsExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminpqrsController extends Controller
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
        $pqrs = PQRS::where('active', '<>', '0')
            ->orderBy('id', 'desc')
            ->paginate(15);
        return view('pqrs.admin.index', compact('pqrs'));
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
     * @param  \App\Pqrs  $pqrs
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pqrs = Pqrs::findOrFail($id);
        return view('pqrs.admin.show', compact('pqrs'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pqrs  $pqrs
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = auth()->user()->id;
        $pqrs = Pqrs::findOrFail($id);
        $other_pqrs = Pqrs::where('document', $pqrs->document)
            ->where('doctype', $pqrs->doctype)
            ->where('id', '<>', $pqrs->id)
            ->get();
        return view('pqrs.admin.edit', compact('user', 'pqrs', 'other_pqrs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pqrs  $pqrs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pqrs = Pqrs::findOrFail($id);
        if ($request->cerrar) {
            $pqrs->active = 0;
        } else {
            $pqrs->active = 2;
        }
        $pqrs->user_id = auth()->user()->id;
        $pqrs->feedback = $pqrs->feedback . PHP_EOL .  auth()->user()->name . PHP_EOL . 
          (new \DateTime())->format('Y-m-d H:i:s') . PHP_EOL . $request->newfeedback;
        $pqrs->save();
        return redirect('adminpqrs');
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

    /**
     * Display a listing of the resource.
     *
     * @return CSV file
     */
    public function export()
    {
        return Excel::download(new PqrsExport, 'pqrs.csv', \Maatwebsite\Excel\Excel::CSV, [
            'Content-Type' => 'text/csv',
        ]);
    }

    public function download()
    {
        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Content-type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename=pqrs.csv',
            'Expires'             => '0',
            'Pragma'              => 'public',
        ];

        $list = Pqrs::all()->toArray();

        # add headers for each column in the CSV download
        array_unshift($list, array_keys($list[0]));

        $callback = function() use ($list) 
            {
                $FH = fopen('php://output', 'w');
                foreach ($list as $row) { 
                    fputcsv($FH, $row);
                }
                fclose($FH);
            };

        return response()->stream($callback, 200, $headers);
    }

    public function search($document)
    {
        $user = auth()->user()->id;
        $pqrs = Pqrs::where('document', $document)
            ->get();
        return view('pqrs.admin.search', compact('pqrs'));
    }

    public function find(Request $request)
    {
        return redirect()->route('adminpqrs.search', $request->document);
    }

}
