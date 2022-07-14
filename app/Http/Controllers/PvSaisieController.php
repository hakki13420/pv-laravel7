<?php

namespace App\Http\Controllers;

use App\Pv;
use App\User;
use App\Grade;
use App\Commune;
use App\Product;
use App\Service;
use App\Tsaisie;
use App\Activite;
use App\Category;
use App\Exercice;
use App\Commercant;
use App\Infraction;
use App\Typesaisie;
use App\Adresse_com;
use App\Activite_com;
use App\Model_redaction;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Foreach_;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

class PvSaisieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function print($id)
    {
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $pv=Pv::with(['commercant','adresse_com','activite_com','service','tsaisie','user1','user2','user3'])->where('id',$id)->first();
        //dd($pv->user1->name);die();
        // $grade1=Grade::where('id',$pv->user1->grade_id)->first();
        // $grade2=Grade::where('id',$pv->user2->grade_id)->first();
        // $grade3=Grade::where('id',$pv->user3->grade_id)->first();
        $activite_com=Activite_com::where('id',$pv->activite_com_id)->first();
        $activite=Activite::where('id',$activite_com->activite_id)->first();
        $grades=Grade::all();


        $tsaisie=Tsaisie::with(['typesaisie','category'])->where('pv_id',$pv->id)->first();


        if(isset($tsaisie)){
            //$produits_saisie=DB::table('product_tsaisie')->where('tsaisie_id',$tsaisie->id)->get();
            $produits_saisie=array();
            foreach($tsaisie->products as $product){

                $produits_saisie[]=array(
                    "product"=>$product->libelle,
                    "qte"=>$product->pivot->qte,
                    "unite"=>$product->pivot->unite,
                    "pu"=>$product->pivot->pu,
                    "somme"=>$product->pivot->somme,
                );
            }
        }


        return response()->json([
            'pv'            => $pv,
            'activite'            => $activite->libelle,
            'grades'            => $grades,
            'tsaisie'            => $tsaisie,
            'produits_saisie'            => isset($tsaisie)?$produits_saisie:'',
             'actual_link'             => $actual_link,
            // 'grade2'            => $grade2,
            // 'grade3'            => $grade3,
        ]);

        //return redirect()->route('pvCreate',['commercant_id' => $id]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

}
