<?php

namespace App\Http\Controllers;

use App\Commune;
use App\Commercant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommercantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $communes=Commune::all();
        $commercants=Commercant::with(['commune'])
                            ->paginate(5);
        return response()->json([
            'commercants' => $commercants,
            'communes' => $communes,
           //'count' => $commercants->count(),
        ]);
    }


    public function getCommercantById($id)
    {
        $communes=Commune::all();
        $commercants=Commercant::where('id',$id)->paginate(5);
        return response()->json([
            'commercants' => $commercants,
            'communes' => $communes
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
            'nrc'      =>'required',
            'name'      =>'required',
            //'rais_soc'      =>'required',
            'date_n'      =>'date|required',
            'lieux_n'      =>'required',
            'adresse_d'      =>'required',
            'tel'      =>'required',
            'pere'      =>'required',
            'mere'      =>'required',
        ]);

        Commercant::create([
            'nrc'         =>$request->nrc,
            'name'           =>$request->name,
            'rais_soc'          =>$request->rais_soc,
            'date_n'          =>$request->date_n,
            'lieux_n'          =>$request->lieux_n,
            'adresse_d'          =>$request->adresse_d,
            'commune_id'      =>$request->commune_id,
            'tel'          =>$request->tel,
            'pere'          =>$request->pere,
            'mere'          =>$request->mere,
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
        $commercant=Commercant::findOrFail($id);

        $request->validate([
            'nrc'      =>'required',
            'name'      =>'required',
            //'rais_soc'      =>'required',
            'date_n'      =>'date|required',
            'lieux_n'      =>'required',
            'adresse_d'      =>'required',
            'tel'      =>'required',
            'pere'      =>'required',
            'mere'      =>'required',
        ]);
        $commercant->update([
            'nrc'         =>$request->nrc,
            'name'           =>$request->name,
            'rais_soc'          =>$request->rais_soc,
            'date_n'          =>$request->date_n,
            'lieux_n'          =>$request->lieux_n,
            'adresse_d'          =>$request->adresse_d,
            'commune_id'      =>$request->commune_id,
            'tel'          =>$request->tel,
            'pere'          =>$request->pere,
            'mere'          =>$request->mere,
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
            $commercant=Commercant::findOrFail($id);
            $commercant->delete();
        }else{
            return response()->json([
                'error' =>"vous n\'avez pas d\'autorisations pour effectuer cette operation"
            ]);
        }
    }


    public function search($q)
    {
        $commercants=Commercant::where('name','LIKE',"%$q%")
                    ->orwhere('rais_soc','LIKE',"%$q%")
                    ->orwhere('adresse_d','LIKE',"%$q%")
                    ->orwhere('nrc','LIKE',"%$q%")
                    ->orwhere('date_n','LIKE',"%$q%")
                    ->orwhere('pere','LIKE',"%$q%")
                    ->orwhere('mere','LIKE',"%$q%")
                    ->paginate(5);
        return response()->json([
            'commercants'    =>$commercants,
        ]);
    }
}
