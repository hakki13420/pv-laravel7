<?php

namespace App\Http\Controllers;

use App\Commune;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommuneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $communes=Commune::paginate(5);
        return response()->json([
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

            'commune'      =>'required',
            'daira'      =>'required',
            'wilaya'      =>'required',
            //'service_id'      =>'required',

        ]);

        Commune::create([
            'commune'         =>$request->commune,
            'daira'           =>$request->daira,
            'wilaya'          =>$request->wilaya,
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
        $commune=Commune::findOrFail($id);

        $request->validate([
            'commune'        =>'required',
            'daira'          =>'required',
            'wilaya'         =>'required',
            //'service_id'     =>'required',
        ]);
        $commune->update([
            'commune'       =>$request->commune,
            'daira'         =>$request->daira,
            'wilaya'        =>$request->wilaya,
            //'service_id'    =>$request->service_id,
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
            $commune=Commune::findOrFail($id);
            $commune->delete();
        }else{
            return response()->json([
                'error' =>"vous n\'avez pas d\'autorisations pour effectuer cette operation"
            ]);
        }
    }


    public function search($q)
    {
        $communes=Commune::where('commune','LIKE',"%$q%")
                    ->orwhere('diara','LIKE',"%$q%")
                    ->orwhere('wilaya','LIKE',"%$q%")
                    ->paginate(5);
        return response()->json([
            'communes'    =>$communes,
        ]);
    }
}
