<?php

namespace App\Http\Controllers;

use App\Activite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ActiviteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activites=Activite::paginate(20);
        return response()->json([
            'activites' => $activites
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
            'code'      =>'required',
            'libelle'      =>'required',
            'libelle_fr'      =>'required',
        ]);

        Activite::create([
            'code'      =>$request->code,
            'libelle'         =>$request->libelle,
            'libelle_fr'         =>$request->libelle_fr,
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
        $activite=Activite::findOrFail($id);

        $request->validate([
            'code'      =>'required',
            'libelle'        =>'required',
            'libelle_fr'        =>'required',
        ]);
        $activite->update([
            'code'       =>$request->code,
            'libelle'       =>$request->libelle,
            'libelle_fr'         =>$request->libelle_fr,
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
            $activite=Activite::findOrFail($id);
            $activite->delete();
        }else{
            return response()->json([
                'error' =>"vous n\'avez pas d\'autorisations pour effectuer cette operation"
            ]);
        }
    }


    public function search($q)
    {
        $activites=Activite::where('libelle','LIKE',"%$q%")
                            ->orWhere('libelle_fr','LIKE',"%$q%")
                            ->orWhere('code','LIKE',"%$q%")
                            ->paginate(20);
        return response()->json([
            'activites'    =>$activites,
        ]);
    }
}
