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
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Foreach_;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role', '!=', 'Admin')->get();
        $services = Service::all();
        $commercants = Commercant::all();
        switch (auth()->user()->role) {
            case 'Admin': {
                    $pvs = Pv::with(['commercant', 'service', 'user1', 'user2', 'user3'])
                        ->latest()
                        ->paginate(5);
                    break;
                }
            case 'Chef': {
                    //$agents=User::where('service_id',auth()->user()->service_id)->get();

                    $agents = Arr::pluck(User::where('service_id', auth()->user()->service_id)
                        ->where('role', '!=', 'Admin')->get(), 'id');

                    $pvs = Pv::with(['commercant', 'service', 'user1', 'user2', 'user3'])
                        ->whereIn('user1', $agents)
                        ->orWhereIn('user2', $agents)
                        ->orwhereIn('user3', $agents)
                        ->latest()
                        ->paginate(5);
                    break;
                }
            case 'Agent': {
                    $pvs = Pv::with(['commercant', 'service', 'user1', 'user2', 'user3'])->where('user1', Auth::user()->id)
                        ->orWhere('user2', Auth::user()->id)
                        ->orWhere('user3', Auth::user()->id)
                        ->latest()
                        ->paginate(5);
                    break;
                }
        }


        return response()->json([
            'pvs'           => $pvs,
            'services'      => $services,
            'commercants'   => $commercants,
            'users'         => $users
        ]);
    }

    public function getCommercantPvs($id)
    {
        $commercants = Commercant::where('id', '=', $id)->get();
        $adresse_coms = Adresse_com::where('commercant_id', $id)->get();
        $activite_coms = Activite_com::with('activite')->where('commercant_id', $id)->get();

        switch (auth()->user()->role) {
            case 'Admin': {
                    $users = User::where('role', '!=', 'Admin')
                        ->get();
                    $pvs = Pv::with(['commercant', 'service', 'user1', 'user2', 'user3'])->where('commercant_id', '=', $id)
                        ->orderBy('date_pv', 'DESC')
                        ->get();
                    break;
                }
            case 'Chef': {
                    $users = User::where('service_id', auth()->user()->service_id)
                        ->where('role', '!=', 'Admin')
                        ->get();
                    $pvs = Pv::with(['commercant', 'service', 'user1', 'user2', 'user3'])->where('commercant_id', '=', $id)
                        ->where('service_id', Auth::user()->service_id)
                        ->get();
                    break;
                }
            case 'Agent': {
                    $users = User::where('brigade_id', auth()->user()->brigade_id)
                        ->where('service_id', auth()->user()->service_id)
                        ->where('role', '!=', 'Admin')
                        ->get();
                    $pvs = Pv::with(['commercant', 'service', 'user1', 'user2', 'user3'])->where('commercant_id', '=', $id)
                        ->where('user1', Auth::user()->id)
                        ->orWhere('user2', Auth::user()->id)
                        ->orwhere('user3', Auth::user()->id)
                        ->get();
                    break;
                }
        }

        $services = Service::where('id', auth()->user()->service_id)
            ->get();

        //$users=User::all();
        $infractions = Infraction::all();
        //$services=Service::all();
        $products = Product::all();
        $typesaisies = Typesaisie::all();
        $categories = Category::all();
        return response()->json([
            'pvs'                   =>  $pvs,
            'commercants'           =>  $commercants,
            'adresse_coms'          =>  $adresse_coms,
            'activite_coms'         =>  $activite_coms,
            'users'                 =>  $users,
            'infractions'           =>  $infractions,
            'services'              =>  $services,
            'products'              =>  $products,
            'typesaisies'           =>  $typesaisies,
            'categories'           =>  $categories,
        ]);
    }
    public function getRedactionModel($id)
    {
        $model_redactions = Model_redaction::where('infraction_id', $id)->get();
        return response()->json([
            'model_redactions'  => $model_redactions,
        ]);
    }

    public function printPv($id)
    {
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/home#$_SERVER[REQUEST_URI]";
        $pv = Pv::with(['commercant', 'adresse_com', 'activite_com', 'service', 'tsaisie', 'user1', 'user2', 'user3'])->where('id', $id)->first();
        //dd($pv->user1->name);die();
        // $grade1=Grade::where('id',$pv->user1->grade_id)->first();
        // $grade2=Grade::where('id',$pv->user2->grade_id)->first();
        // $grade3=Grade::where('id',$pv->user3->grade_id)->first();
        $activite_com = Activite_com::where('id', $pv->activite_com_id)->first();
        $activite = Activite::where('id', $activite_com->activite_id)->first();
        $grades = Grade::all();
        $commune_n = Commune::where('id', $pv->commercant->lieux_n)->first();
        $exercice = Exercice::where('year', 2021)->first();
        $tsaisie = Tsaisie::with(['typesaisie', 'category'])->where('pv_id', $pv->id)->first();


        if (isset($tsaisie)) {
            //$produits_saisie=DB::table('product_tsaisie')->where('tsaisie_id',$tsaisie->id)->get();
            $produits_saisie = array();
            foreach ($tsaisie->products as $product) {

                $produits_saisie[] = array(
                    "product" => $product->libelle,
                    "qte" => $product->pivot->qte,
                    "unite" => $product->pivot->unite,
                    "pu" => $product->pivot->pu,
                    "somme" => $product->pivot->somme,
                );
            }
        }

        return response()->json([
            'pv'            => $pv,
            'activite'            => $activite->libelle,
            'grades'            => $grades,
            'year'            => $exercice->libelle,
            'commune_n'            => $commune_n->commune,
            'infractions'            => $pv->infractions,
            'tsaisie'            => $tsaisie,
            'produits_saisie'            => isset($tsaisie) ? $produits_saisie : '',
            'actual_link'            => $actual_link,
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
    public function create()
    {
        $users = User::where('brigade_id', auth()->user()->brigade_id)
            ->where('service_id', auth()->user()->service_id)
            ->where('role', '!=', 'Admin')
            ->get();

        $services = Service::where('id', auth()->user()->service_id)
            ->get();
        $adresse_coms = Adresse_com::all();
        $activite_coms = Activite_com::with('activite')->get();
        $commercants = Commercant::all();
        $infractions = Infraction::all();
        //$pvs=Pv::paginate(5);
        return response()->json([
            //'pvs'           => $pvs,
            'services'      => $services,
            'commercants'   => $commercants,
            'adresse_coms'   => $adresse_coms,
            'activite_coms'   => $activite_coms,
            'users'         => $users,
            'infractions'         => $infractions,
        ]);
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
            'num_pv'                => 'required',
            'date_pv'               => 'required',
            'hour_pv'               => 'required',
            'min_pv'                => 'required',
            'commercant_id'         => 'required',
            'adresse_com_id'        => 'required',
            'activite_com_id'       => 'required',
            'user1'                 => 'required',
            'user2'                 => 'required',
            'service_id'            => 'required',
            'date_constat'          => 'date|required',
            'num_conv'              => 'required',
            'date_conv'             => 'date|required',
            'redaction'             => 'required',
            'infractions'           => 'required',
            'amande'                => 'required',
            'signature'             => 'required',
        ]);


        $pv = Pv::create([
            'num_pv'            => $request->num_pv,
            'date_pv'           => $request->date_pv,
            'hour_pv'           => $request->hour_pv,
            'min_pv'            => $request->min_pv,
            'commercant_id'     => $request->commercant_id,
            'adresse_com_id'    => $request->adresse_com_id,
            'activite_com_id'   => $request->activite_com_id,
            'user1'             => $request->user1,
            'user2'             => $request->user2,
            'user3'             => $request->user3,
            'service_id'        => $request->service_id,
            'date_constat'      => $request->date_constat,
            'num_conv'          => $request->num_conv,
            'date_conv'         => $request->date_conv,
            'amande'            => $request->amande,
            'redaction'         => $request->redaction,
            'commentaires'      => $request->commentaires,
            'signature'         => $request->signature == "true" ? true : false,
            'created_by'        => auth()->user()->name,
        ]);

        if ($request->infractions) {

            $infractions_array = [];
            foreach ($request->infractions as $infra) {
                array_push($infractions_array, $infra['infraction_id']);
            }
            $infraction = Infraction::whereIn('id', $infractions_array)->get();
            $pv->infractions()->sync($infraction);
        }

        if ($request->products_saisie) {
            $tsaisie = Tsaisie::create([
                'pv_id'                => $pv->id,
                'typesaisie_id'        => $request->typesaisie_id,
                'category_id'          => $request->category_id,
                'num_saisie'          => $request->num_saisie,
                'date_saisie'          => $request->date_saisie,
                'lieux_saisie'          => $request->lieux_saisie,
                'depot_saisie'          => $request->depot_saisie,
                'quantite'             => $request->sommeqte,
                'sommeDa'              => $request->sommeDa,
                'created_by'           => auth()->user()->name,
            ]);

            $products_array = [];
            $data_array = [];

            foreach ($request->products_saisie as $product) {
                //array_push($products_array,$product['product_id']);
                $data_array[$product['product_id']] = [
                    'qte' => $product['qte'],
                    'unite' => $product['unite'],
                    'pu' => $product['pu'],
                    'somme' => $product['total'],
                    'created_by' => auth()->user()->name,
                ];
            }

            //$prod=Product::where('id',$product['product_id'])->get();
            $tsaisie->products()->sync($data_array);
            $pv->update(['hasSaisie'    => 1]);
        }
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
        $pv = Pv::where('id', $id)->first();
        //dd($pv);
        $commercants = Commercant::where('id', $pv->commercant_id)->get();
        $adresse_coms = Adresse_com::where('commercant_id', $pv->commercant_id)->get();
        // $users=User::where('role','!=','Admin')->get();
        $infractions = Infraction::all();
        $services = Service::all();
        $products = Product::all();
        $categories = Category::all();
        $typesaisies = Typesaisie::all();
        $activite_coms = Activite_com::where('commercant_id', $pv->commercant_id)->get();
        $infraction_pv = DB::table('infraction_pv')->where('pv_id', $id)->get();
        $tsaisie = Tsaisie::where('pv_id', $id)->first();
        //dd($tsaisie);
        //die();
        if ($tsaisie) {
            $product_tsaisie = DB::table('product_tsaisie')->where('tsaisie_id', $tsaisie->id)->get();
        }



        switch (auth()->user()->role) {
            case 'Admin': {
                    $users = User::where('role', '!=', 'Admin')
                        ->get();
                    break;
                }
            case 'Chef': {
                    $users = User::where('service_id', auth()->user()->service_id)
                        ->where('role', '!=', 'Admin')
                        ->get();
                    break;
                }
            case 'Agent': {
                    $users = User::where('brigade_id', auth()->user()->brigade_id)
                        ->where('service_id', auth()->user()->service_id)
                        ->where('role', '!=', 'Admin')
                        ->get();
                    break;
                }
        }




        return response()->json([
            'commercants'            => $commercants,
            'adresse_coms'          => $adresse_coms,
            'activite_coms'         => $activite_coms,
            'pv'                    => $pv,
            'infractions'           => $infractions,
            'infraction_pv'         => $infraction_pv,
            'tsaisie'               => $tsaisie ? $tsaisie : null,
            'product_tsaisie'       => isset($product_tsaisie) ? $product_tsaisie : null,
            'users'                 => $users,
            'services'              => $services,
            'products'              => $products,
            'categories'            => $categories,
            'typesaisies'           => $typesaisies,
        ]);

        //return redirect()->route('pvCreate',['commercant_id' => $id]);
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
        $pv = Pv::findOrFail($id);

        $request->validate([
            'num_pv'                => 'required',
            'date_pv'               => 'required',
            'hour_pv'               => 'required',
            'min_pv'                => 'required',
            'commercant_id'         => 'required',
            'adresse_com_id'        => 'required',
            'activite_com_id'       => 'required',
            'user1'                 => 'required',
            'user2'                 => 'required',
            'service_id'            => 'required',
            'date_constat'          => 'date|required',
            'num_conv'              => 'required',
            'date_conv'             => 'date|required',
            'redaction'             => 'required',
            'infractions'           => 'required',
            'amande'                => 'required',
            'signature'                => 'required',
        ]);


        $pv->update([
            'num_pv'            => $request->num_pv,
            'date_pv'           => $request->date_pv,
            'hour_pv'           => $request->hour_pv,
            'min_pv'            => $request->min_pv,
            'commercant_id'     => $request->commercant_id,
            'adresse_com_id'    => $request->adresse_com_id,
            'activite_com_id'   => $request->activite_com_id,
            'user1'             => $request->user1,
            'user2'             => $request->user2,
            'user3'             => $request->user3,
            'service_id'        => $request->service_id,
            'date_constat'      => $request->date_constat,
            'num_conv'          => $request->num_conv,
            'date_conv'         => $request->date_conv,
            'amande'            => $request->amande,
            'redaction'         => $request->redaction,
            'commentaires'      => $request->commentaires,
            'signature'         => $request->signature == "true" ? true : false,
            'updated_by'      => auth()->user()->name
        ]);

        if ($request->infractions) {

            $infractions_array = [];
            foreach ($request->infractions as $infra) {
                array_push($infractions_array, $infra['infraction_id']);
            }
            $infraction = Infraction::whereIn('id', $infractions_array)->get();
            $pv->infractions()->sync($infraction);
        }

        if ($request->products_saisie) {
            $tsaisies = Tsaisie::where('pv_id', $pv->id)->first();

            if (isset($tsaisies)) {
                $tsaisie = Tsaisie::findOrFail($tsaisies->id);

                $tsaisie->update([
                    'pv_id'                => $pv->id,
                    'typesaisie_id'        => $request->typesaisie_id,
                    'category_id'          => $request->category_id,
                    'num_saisie'          => $request->num_saisie,
                    'date_saisie'          => $request->date_saisie,
                    'lieux_saisie'          => $request->lieux_saisie,
                    'depot_saisie'          => $request->depot_saisie,
                    'quantite'             => $request->sommeqte,
                    'sommeDa'              => $request->sommeDa,
                    'updated_by'      => auth()->user()->name
                ]);
                $pv->update(['hasSaisie'    => 1]);
            } else {
                $tsaisie = Tsaisie::create([
                    'pv_id'                => $pv->id,
                    'typesaisie_id'        => $request->typesaisie_id,
                    'category_id'          => $request->category_id,
                    'num_saisie'          => $request->num_saisie,
                    'date_saisie'          => $request->date_saisie,
                    'lieux_saisie'          => $request->lieux_saisie,
                    'depot_saisie'          => $request->depot_saisie,
                    'quantite'             => $request->sommeqte,
                    'sommeDa'              => $request->sommeDa,
                    'created_by'        => auth()->user()->name,
                ]);
                $pv->update(['hasSaisie'    => 1]);
            }

            $products_array = [];
            $data_array = [];

            foreach ($request->products_saisie as $product) {
                //array_push($products_array,$product['product_id']);
                $data_array[$product['product_id']] = [
                    'qte' => $product['qte'],
                    'unite' => $product['unite'],
                    'pu' => $product['pu'],
                    'somme' => $product['total'],
                    'created_by' => auth()->user()->name,
                    'updated_by'      => auth()->user()->name
                ];
            }

            //$prod=Product::where('id',$product['product_id'])->get();
            $tsaisie->products()->sync($data_array);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::allows('isAdmin')) {
            $pv = Pv::findOrFail($id);
            $pv->delete();
        } else {
            return response()->json([
                'error' => "vous n\'avez pas d\'autorisations pour effectuer cette operation"
            ]);
        }
    }


    public function search($q)
    {
        $pvs = Pv::where('date_pv', 'LIKE', "%$q%")
            ->orwhere('num_pv', 'LIKE', "%$q%")
            ->orwhere('num_conv', 'LIKE', "%$q%")
            ->paginate(5);
        return response()->json([
            'pvs'    => $pvs,
        ]);
    }
}
