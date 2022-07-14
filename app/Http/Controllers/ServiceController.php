<?php

namespace App\Http\Controllers;

use App\User;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services=Service::paginate(5);
        $chefs=User::where('role','Chef')->get();
        return response()->json([
            'services' => $services,
            'chefs' => $chefs,
        ]);
    }


    public function getServiceById($id)
    {
        $services=Service::where('id',$id)->paginate(5);
        $chefs=User::where('role','Chef')->get();
        return response()->json([
            'services' => $services,
            'chefs' => $chefs,
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

            'service'      =>'required',
            'adresse'      =>'required',
            'contact'      =>'required',

        ]);

        Service::create([
            'service'         =>$request->service,
            'adresse'           =>$request->adresse,
            'contact'          =>$request->contact,
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
        $service=Service::findOrFail($id);

        $request->validate([
            'service'        =>'required',
            'adresse'          =>'required',
            'contact'         =>'required',
        ]);
        $service->update([
            'service'       =>$request->service,
            'adresse'         =>$request->adresse,
            'contact'        =>$request->contact,
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
            $service=Service::findOrFail($id);
            $service->delete();
        }else{
            return response()->json([
                'error' =>"vous n\'avez pas d\'autorisations pour effectuer cette operation"
            ]);
        }
    }


    public function search($q)
    {
        $services=Service::where('service','LIKE',"%$q%")
                    ->orwhere('adresse','LIKE',"%$q%")
                    ->orwhere('contact','LIKE',"%$q%")
                    ->paginate(5);
        return response()->json([
            'services'    =>$services,
        ]);
    }
}
