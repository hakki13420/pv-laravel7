<?php

namespace App\Http\Controllers;


use App\Brigade;
use App\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;



class BrigadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();
        $brigades = Brigade::with(['service'])->paginate(5);
        return response()->json([
            'brigades' => $brigades,
            'services' => $services,
        ]);
    }

    public function getBrigadeById($id)
    {
        $services = Service::all();
        $brigades = Brigade::with(['service'])->where('id', $id)->paginate(5);
        return response()->json([
            'brigades' => $brigades,
            'services' => $services,
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
            'code'   => 'required',
            'libelle'   => 'required',
            'service'   => 'required',
        ]);

        Brigade::create([
            'code'          => $request->code,
            'libelle'       => $request->libelle,
            'service_id'    => $request->service,
            'created_by'    => Auth::user()->name
        ]);
        //        return $request->role;
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
        $brigade = Brigade::findOrFail($id);
        $request->validate([
            'code'          => 'required',
            'libelle'       => 'required',
            'service'       => 'required',
        ]);
        $brigade->update([
            'code'   => $request->code,
            'libelle'   => $request->libelle,
            'service_id'   => $request->service,
            'updated_by'      =>auth()->user()->name
        ]);
        //      return 'ok';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$this->authorize('isAdmin');
        if (Gate::forUser(Auth::guard('admin')->user())->allows('isAdmin')) {
            $brigade = Brigade::findOrFail($id);
            $brigade->delete();
        }
        if (Gate::forUser(Auth::guard('admin')->user())->denies('isAdmin')) {
            return 'error dont have authorization';
        }
    }

    public function search($q)
    {
        $brigades = Brigade::with(['service'])
            ->where('libelle', 'LIKE', "%$q%")
            ->orwhere('code', 'LIKE', "%$q%")
            ->orwhere('service_id', 'LIKE', "%$q%")
            ->paginate(5);
            return response()->json([
                'brigades' => $brigades,
            ]);


    }
}
