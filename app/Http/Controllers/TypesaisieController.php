<?php

namespace App\Http\Controllers;

use App\Commune;
use App\Typesaisie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TypesaisieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typesaisies=Typesaisie::paginate(5);
        return response()->json([
            'typesaisies' => $typesaisies
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

            'libelle'      =>'required',
        ]);

        Typesaisie::create([
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
        $typesaisie=Typesaisie::findOrFail($id);

        $request->validate([
            'libelle'        =>'required',
        ]);
        $typesaisie->update([
            'libelle'       =>$request->libelle,
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
            $typesaisie=Commune::findOrFail($id);
            $typesaisie->delete();
        }else{
            return response()->json([
                'error' =>"vous n\'avez pas d\'autorisations pour effectuer cette operation"
            ]);
        }
    }


    public function search($q)
    {
        $typesaisies=Typesaisie::where('libelle','LIKE',"%$q%")
                    ->paginate(5);
        return response()->json([
            'typesaisies'    =>$typesaisies,
        ]);
    }
}
