<?php

namespace App\Http\Controllers;

use App\Activite;
use App\Commercant;
use App\Activite_com;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ActivitesComController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function getActivitesCom($id)
    {
        $activites=Activite::all();
        $commercant=Commercant::where('id',$id)->get();
        $activite_coms=Activite_com::where('commercant_id',$id)
                        ->get();
        return response()->json([
            'activite_coms' => $activite_coms,
            'commercant' => $commercant,
            'activites' => $activites,
        ]);
    }

    public function index()
    {
        $activites=Activite::all();
        $commercant=Commercant::where('id',$id)->get();
        $activite_coms=Activite_com::where('commercant_id',$id)
                        ->get();
        return response()->json([
            'activite_coms' => $activite_coms,
            'commercant' => $commercant,
            'activites' => $activites,
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
            'activite_id'      =>'required',
            'libelle'      =>'required',
            'commercant_id'      =>'required',
        ]);

        Activite_com::create([
            'activite_id'       =>$request->activite_id,
            'libelle'           =>$request->libelle,
            'commercant_id'     =>$request->commercant_id,
            'created_by'        =>auth()->user()->name
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
        $activite_com=Activite_com::findOrFail($id);

        $request->validate([
            'activite_id'       =>'required',
            'libelle'           =>'required',
            'commercant_id'     =>'required',
        ]);
        $activite_com->update([
            'activite_id'       =>$request->activite_id,
            'libelle'           =>$request->libelle,
            'commercant_id'     =>$request->commercant_id,
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
            $activite_com=Activite_com::findOrFail($id);
            $activite_com->delete();
        }else{
            return response()->json([
                'error' =>"vous n\'avez pas d\'autorisations pour effectuer cette operation"
            ]);
        }
    }


    public function search($q)
    {
        $activite_coms=Activite_com::where('commercant_id','LIKE',"%$q%")
                    ->orwhere('activite_id','LIKE',"%$q%")
                    ->paginate(5);
        return response()->json([
            'activite_coms'    =>$activite_coms,
        ]);
    }
}
