<?php

namespace App\Http\Controllers;

use App\Resultat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ResultatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resultats=Resultat::paginate(5);
        return response()->json([
            'resultats' => $resultats
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

            'libelle'           =>'required',
            'lois'              =>'required',
            'articles'          =>'required',
            'lois_p'            =>'required',
            'articles_p'        =>'required',
            //'autres_mesures'    =>'required',
            //'resultat_id'          =>'required',

        ]);

        Infraction::create([
            'libelle'        =>$request->libelle,
            'lois'           =>$request->lois,
            'articles'       =>$request->articles,
            'lois_p'         =>$request->lois_p,
            'articles_p'     =>$request->articles_p,
            'autres_mesures' =>$request->autres_mesures,
            'resultat_id'    =>$request->resultat_id,
            'created_by'     =>auth()->user()->name
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
        $infraction=Infraction::findOrFail($id);

        $request->validate([
            'libelle'        =>'required',
            'lois'           =>'required',
            'articles'       =>'required',
            'lois_p'         =>'required',
            'articles_p'     =>'required',
            //'autres_mesures' =>'required',
        ]);
        $infraction->update([
            'libelle'           =>$request->libelle,
            'lois'              =>$request->lois,
            'articles'          =>$request->articles,
            'lois_p'            =>$request->lois_p,
            'articles_p'        =>$request->articles_p,
            'autres_mesures'    =>$request->autres_mesures,
            'resultat_id'       =>$request->resultat_id,
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
            $infraction=Infraction::findOrFail($id);
            $infraction->delete();
        }else{
            return response()->json([
                'error' =>"vous n\'avez pas d\'autorisations pour effectuer cette operation"
            ]);
        }
    }


    public function search($q)
    {
        $infractions=Infraction::where('libelle','LIKE',"%$q%")
                    ->orwhere('lois','LIKE',"%$q%")
                    ->orwhere('articles','LIKE',"%$q%")
                    ->orwhere('lois_p','LIKE',"%$q%")
                    ->orwhere('articles_p','LIKE',"%$q%")
                    ->orwhere('autres_mesures','LIKE',"%$q%")
                    ->paginate(5);
        return response()->json([
            'infractions'    =>$infractions,
        ]);
    }
}
