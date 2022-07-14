<?php

namespace App\Http\Controllers;


use App\Pv;
use App\Service;
use App\Commercant;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;




class StatistiqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getStatistiques()
    {
        $services=Service::all();
        $statistiques=Pv::with(['service','commercant','user1','user2','user3','infractions'])
        ->orderBy('service_id')
        ->orderBy('user1')
        ->paginate(5);

        return response()->json([
            'statistiques'  => $statistiques,
            'services'      => $services,
        ]);
    }

    public function getStatistiquesBetween(Request $request)
    {
        $request->validate([
            'date1'=>'date|required',
            'date2'=>'date|required',
        ]);
        $services=Service::all();
        $statistiques=Pv::with(['service','commercant','user1','user2','user3','infractions'])
                ->whereBetween('date_pv', [$request->date1, $request->date2])
                ->orderBy('service_id')
                ->orderBy('user1')
                ->paginate(5);

        return response()->json([
            'statistiques' => $statistiques,
            'services'      => $services,
        ]);
    }
    public function getStatistiquesService(Request $request)
    {
        $request->validate([
            'service'=>'required',
        ]);
        //return $request->all();
        $services=Service::all();
        $statistiques=Pv::with(['service','commercant','user1','user2','user3','infractions'])
        ->where('service_id', $request->service)
        ->orderBy('date_pv')
        ->paginate(5);

        return response()->json([
            'statistiques' => $statistiques,
            'services'      => $services,
        ]);

    }

    public function getStatistiquesOperateur(Request $request)
    {
        $request->validate([
            'searchData'=>'required',
        ]);

        //return $request->all();
        $commercants=Commercant::where('name','LIKE',"%$request->searchData%")
                                ->orWhere('rais_soc','LIKE',"%$request->searchData%")
                                ->orWhere('nrc','LIKE',"%$request->searchData%")
                                ->get();
        $commercants=Arr::pluck($commercants,'id');
        $services=Service::all();

        $statistiques=Pv::with(['service','commercant','user1','user2','user3','infractions'])
        ->whereIn('commercant_id', $commercants)
        ->orderBy('date_pv')
        ->paginate(5);

        return response()->json([
            'statistiques' => $statistiques,
            'services'      => $services,
        ]);

    }

    }
