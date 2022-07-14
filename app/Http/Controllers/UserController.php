<?php

namespace App\Http\Controllers;

use App\User;
use App\Grade;
use App\Brigade;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades=Grade::all();
        switch(auth()->user()->role){
            case 'Admin':{
                $users=User::with(['brigade','service'])
                        ->where('role','!=','Admin')
                        ->paginate(5);
                $services=Service::all();
                $brigades=Brigade::with('service')->get();
                return response()->json([
                    'users' => $users,
                    'grades' => $grades,
                    'services' => $services,
                    'brigades' => $brigades,
                ]);
                break;
            }
            case 'Chef':{
                $users=User::with(['brigade','service'])
                            ->where('service_id',auth()->user()->service_id)
                            ->where('role','!=','Admin')
                            ->paginate(5);
                $services=Service::where('id',auth()->user()->service_id)
                            ->get();
                $brigades=Brigade::with('service')->where('service_id',auth()->user()->service_id)
                            ->get();
                return response()->json([
                    'users' => $users,
                    'grades' => $grades,
                    'services' => $services,
                    'brigades' => $brigades,
                ]);
                break;
            }
        }

    }


    public function getUserById($id)
    {
        $grades=Grade::all();
        $users=User::where('id',$id)->with(['brigade','service'])
                            ->paginate(5);
        $services=Service::all();
        $brigades=Brigade::with('service')->get();
        return response()->json([
            'users' => $users,
            'grades' => $grades,
            'services' => $services,
            'brigades' => $brigades,
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

            'name'                  =>'required',
            'email'                 =>'required|unique:users',
            'password'              =>'required|min:6',
            'role'                  =>'required',
            'grade_id'              =>'required',
            'service'              =>'required',
            'brigade'              =>auth()->user()->role=="Agent"?'required':'',
            'carte_com'             =>'required',
            'date_carte_com'        =>'required',

        ]);

        User::create([
            'name'              =>$request->name,
            'email'             =>$request->email,
            'password'          =>hash::make($request->password),
            'role'              =>$request->role,
            'grade_id'          =>$request->grade_id,
            'service_id'          =>$request->service,
            'brigade_id'          =>$request->brigade,
            'carte_com'         =>$request->carte_com,
            'date_carte_com'    =>$request->date_carte_com,
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
        $user=User::findOrFail($id);

        $request->validate([
            'name'                  =>'required',
            'email'                 =>'required|unique:users,email,'.$user->id,
            'password'              =>'sometimes',
            'role'                  =>'required',
            'grade_id'              =>'required',
            'service'               =>'required',
            'brigade'               =>auth()->user()->role=="Agent"?'required':'',
            'carte_com'             =>'required',
            'date_carte_com'        =>'required',
        ]);
        $request->password=$request->password==""?$user->password:Hash::make($request->password);
        $user->update([
            'name'              =>$request->name,
            'email'             =>$request->email,
            'password'          =>$request->password,
            'role'              =>$request->role,
            'grade_id'          =>$request->grade_id,
            'service_id'          =>$request->service,
            'brigade_id'          =>$request->brigade,
            'carte_com'         =>$request->carte_com,
            'date_carte_com'    =>$request->date_carte_com,
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
        if(Gate::allows('isAgent')){
            $user=User::findOrFail($id);
            $user->delete();
        }else{
            return response()->json([
                'error' =>"vous n\'avez pas d\'autorisations pour effectuer cette operation"
            ]);
        }
    }


    public function search($q,Request $request)
    {

            $users=User::with(['brigade','service'])
                        ->where('role','!=',"Admin")
                        ->where('name','LIKE',"%$q%")
                        ->orWhere(function ($query) use ($q) {

                            $query->where('email','LIKE',"%$q%")
                                  ->where('role','LIKE',"%$q%")
                                  ->where('carte_com','LIKE',"%$q%")
                                  ->where('date_carte_com','LIKE',"%$q%");
                        })->paginate(5);
            return response()->json([
                'users' => $users,
            ]);




    }
}
