<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Exercice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ExerciceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exercices=Exercice::paginate(5);
        return response()->json([
            'exercices' => $exercices
        ]);
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

            'year'      =>'required',
            'libelle'      =>'required',

        ]);

        Exercice::create([
            'year'         =>$request->year,
            'libelle'         =>$request->libelle,
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
        $exercice=Exercice::findOrFail($id);

        $request->validate([
            'year'      =>'required',
            'libelle'      =>'required',

        ]);

        $exercice->update([
            'year'         =>$request->year,
            'libelle'         =>$request->libelle,
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
            $exercice=Exercice::findOrFail($id);
            $exercice->delete();
        }else{
            return response()->json([
                'error' =>"vous n\'avez pas d\'autorisations pour effectuer cette operation"
            ]);
        }
    }


    public function search($q)
    {
        $exercices=Exercice::where('year','LIKE',"%$q%")
                    ->where('libelle','LIKE',"%$q%")
                    ->paginate(5);
        return response()->json([
            'exercices'    =>$exercices,
        ]);
    }
}
