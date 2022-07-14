<?php

namespace App\Http\Controllers;

use App\Commune;
use App\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configurations=Configuration::paginate(5);
        return response()->json([
            'configurations' => $configurations
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

            'ministere'      =>'required',
            'organisme'      =>'required',
            'slogan'      =>'required',
            'adresse'      =>'required',
            'email'      =>'required',
            'site'      =>'required',
            'tel'      =>'required',
            'fax'      =>'required',
            //'service_id'      =>'required',

        ]);

        Commune::create([
            'ministere'         =>$request->ministere,
            'organisme'           =>$request->organisme,
            'slogan'           =>$request->slogan,
            'adresse'          =>$request->adresse,
            'email'      =>$request->email,
            'site'      =>$request->site,
            'tel'      =>$request->tel,
            'fax'      =>$request->fax,
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
        $configuration=Configuration::findOrFail($id);

        $request->validate([
            'ministere'      =>'required',
            'organisme'      =>'required',
            'slogan'      =>'required',
            'adresse'      =>'required',
            'email'      =>'required',
            'site'      =>'required',
            'tel'      =>'required',
            'fax'      =>'required',
        ]);
        $configuration->update([
            'ministere'         =>$request->ministere,
            'organisme'           =>$request->organisme,
            'slogan'           =>$request->slogan,
            'adresse'          =>$request->adresse,
            'email'      =>$request->email,
            'site'      =>$request->site,
            'tel'      =>$request->tel,
            'fax'      =>$request->fax,
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
            $configuration=Configuration::findOrFail($id);
            $configuration->delete();
        }else{
            return response()->json([
                'error' =>"vous n\'avez pas d\'autorisations pour effectuer cette operation"
            ]);
        }
    }


    public function search($q)
    {
        $configurations=Configuration::where('ministere','LIKE',"%$q%")
                    ->orwhere('organisme','LIKE',"%$q%")
                    ->orwhere('adresse','LIKE',"%$q%")
                    ->paginate(5);
        return response()->json([
            'configurations'  =>$configurations,
         ]);
    }
}
