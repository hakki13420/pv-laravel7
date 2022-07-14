<?php

namespace App\Http\Controllers;

use App\Infraction;
use App\Model_redaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ModelRedactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model_redactions=Model_redaction::with('infraction')
                        ->get()
                        ->paginate(5);
        $infractions = Infraction::all();
        return response()->json([
            'model_redactions' => $model_redactions,
            'infractions' => $infractions
        ]);
    }

    public function getModelRedactionsInfraction($id)
    {

        $model_redactions=Model_redaction::with('infraction')
                        ->where("infraction_id",$id)->get();
        $infractions = Infraction::all();
        return response()->json([
            'model_redactions' => $model_redactions,
            'infractions' => $infractions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

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
            'model'      =>'required',
            'title'     =>'required',
            'infraction_id'      =>'required',
        ]);

        Model_redaction::create([
            'model'      =>$request->model,
            'title'      =>$request->title,
            'infraction_id'         =>$request->infraction_id,
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
        $model_redaction=Model_redaction::findOrFail($id);

        $request->validate([
            'model'      =>'required',
            'title'      =>'required',
            'infraction_id'        =>'required',
        ]);
        $model_redaction->update([
            'model'       =>$request->model,
            'title'       =>$request->title,
            'infraction_id'       =>$request->infraction_id,
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
            $model_redaction=Model_redaction::findOrFail($id);
            $model_redaction->delete();
        }else{
            return response()->json([
                'error' =>"vous n\'avez pas d\'autorisations pour effectuer cette operation"
            ]);
        }
    }


    public function search($q)
    {
        $model_redactions=Model_redaction::where('model','LIKE',"%$q%")
                    ->paginate(5);
        return response()->json([
            'model_redactions'    =>$model_redactions,
        ]);
    }
}
