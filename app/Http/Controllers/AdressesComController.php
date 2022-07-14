<?php

namespace App\Http\Controllers;


use App\Commercant;
use App\Adresse_com;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdressesComController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function getAdressesCom($id)
    {
        $commercant=Commercant::where('id',$id)->get();
        $adresse_coms=Adresse_com::where('commercant_id',$id)
                        ->get();
        return response()->json([
            'adresse_coms' => $adresse_coms,
            'commercant' => $commercant,
        ]);
    }

    public function index()
    {
        $commercant=Commercant::where('id',$id)->get();
        $adresse_coms=Adresse_com::where('commercant_id',$id)
                        ->get();
        return response()->json([
            'adresse_coms' => $adresse_coms,
            'commercant' => $commercant,
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
            'adresse_com'      =>'required',
            'commercant_id'      =>'required',
        ]);

        Adresse_com::create([
            'adresse_com'      =>$request->adresse_com,
            'commercant_id'         =>$request->commercant_id,
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
        $adresse_com=Adresse_com::findOrFail($id);

        $request->validate([
            'adresse_com'      =>'required',
            'commercant_id'        =>'required',
        ]);
        $adresse_com->update([
            'adresse_com'       =>$request->adresse_com,
            'commercant_id'       =>$request->commercant_id,
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
            $adresse_com=Adresse_com::findOrFail($id);
            $adresse_com->delete();
        }else{
            return response()->json([
                'error' =>"vous n\'avez pas d\'autorisations pour effectuer cette operation"
            ]);
        }
    }


    public function search($q)
    {
        $adresse_coms=Adresse_com::where('commercant_id','LIKE',"%$q%")
                    ->orwhere('adresse_id','LIKE',"%$q%")
                    ->paginate(5);
        return response()->json([
            'adresse_coms'    =>$adresse_coms,
        ]);
    }
}
