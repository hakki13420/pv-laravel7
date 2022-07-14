<?php

namespace App\Http\Controllers;

use App\Activite;
use App\Redaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RedactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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

        $request->validate([
            'redaction'      =>'required',
            'pv_id'      =>'required',
        ]);

        Redaction::create([
            'redaction'         =>$request->redaction,
            'pv_id'         =>$request->pv_id,
            'created_by'      =>auth()->user()->name
        ]);
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
        $redaction=Redaction::findOrFail($id);

        $request->validate([
            'redaction'      =>'required',
            'pv_id'        =>'required',
        ]);
        $redaction->update([
            'redaction'       =>$request->redaction,
            'pv_id'       =>$request->pv_id,
            'updated_by'      =>auth()->user()->name
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::allows('isAdmin')){
            $redaction=Redaction::findOrFail($id);
            $redaction->delete();
        }else{
            return response()->json([
                'error' =>"vous n\'avez pas d\'autorisations pour effectuer cette operation"
            ]);
        }
    }


    public function search($q)
    {
        $activites=Activite::where('libellee','LIKE',"%$q%")
                    ->paginate(5);
        return response()->json([
            'activites'    =>$activites,
        ]);
    }
}
