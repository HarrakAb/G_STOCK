<?php

namespace App\Http\Controllers;

use App\Models\Arivage;
use App\Models\Article;
use App\Models\BonEntree;
use App\Models\Categorie;
use App\Models\EntreeDetail;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BonEntreeController extends Controller
{

    // function __construct()
    // {
    //     $this->middleware('permission:bon entree', ['only' => ['index']]);
    //     $this->middleware('permission:add bon', ['only' => ['create', 'store' , 'getproducts']]);
    //     $this->middleware('permission:edit bon', ['only' => ['edit', 'update']]);
    //     $this->middleware('permission:delete bon', ['only' => ['destroy']]);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bonEntrees = BonEntree::orderBy('created_at' , 'DESC')->get();
        return view('bonEntrees.listBon',compact('bonEntrees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bons = BonEntree::all();
        $nbRow = count( $bons) + 1;
        if( $nbRow < 10 ) {
            $bl_number = 'BR'.'-'.date('Y')."000".$nbRow;
        }elseif ($nbRow >= 10 && $nbRow <= 99){
            $bl_number = 'BR' . '-'.date('Y')."00".$nbRow;
        }elseif ($nbRow >= 100 &&  $nbRow <= 999){
            $bl_number = 'BL' . '-'.date('Y')."0".$nbRow;
        }elseif ($nbRow >= 1000 ){
            $bl_number = 'BL' . '-'.date('Y').$nbRow;
        }
        //$bon_number = DB::table('bon_sorties')->latest('bon_number')->first();
        $bon_number = $bl_number;
        $fournisseurs = Fournisseur::all();
        $articles = Article::all();
        return view('bonEntrees.creeBon',compact('articles','bon_number','fournisseurs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // try {

            $this->validate($request,[
                'bon_number' => 'required|unique:bon_entrees|max:15',
                'bon_date' => 'required',
                'client_name' => 'required',
                'article.*' => 'required',
                'quantite.*' => 'required',
                'prix_unitaire.*' => 'required',
            ]);

            $bons = BonEntree::all();
            $nbRow = count( $bons);

            $data['bon_date'] = $request->bon_date;
            $data['client_name'] = $request->client_name;
            $data['total'] = $request->total;
            $data['created_by'] = Auth::user()->name;


            $bonEntree = BonEntree::create($data);

            $lastBon =  DB::table('bon_entrees')->latest('id')->first();
            
            $lastBon = $lastBon->id;

            if( $nbRow < 10 ) {
                $bl_number = 'BR'.'-'.date('Y')."000".$lastBon;
            }elseif ($nbRow >= 10 && $nbRow <= 99){
                $bl_number = 'BR' . '-'.date('Y')."00".$lastBon;
            }elseif ($nbRow >= 100 && $nbRow <= 999){
                $bl_number = 'BR' . '-'.date('Y')."0".$lastBon;
            }elseif ($nbRow >= 1000 ){
                $bl_number = 'BR' . '-'.date('Y').$lastBon;
            }

            DB::table('bon_entrees')->where('id', $lastBon)->update(['bon_number' => $bl_number]);
            $arivage_list = [];
            $details_list = [];

            // for arivage
            for ($i = 0; $i < count($request->article); $i++) {

                $arivage_list[$i]['article'] = $request->article[$i];
                $arivage_list[$i]['quantite'] = $request->quantite[$i];
                $arivage_list[$i]['prix_unitaire'] = $request->prix_unitaire[$i];
                
            }
            $bonEntree->arivage()->createMany($arivage_list);

            // for article
            for ($i = 0; $i < count($request->article); $i++) {

                $desc[$i] = Article::whereId($request->descriptionn[$i])->first();

                $details_list[$i]['article'] = $request->article[$i];
                $details_list[$i]['description'] = $desc[$i]->description;
                $details_list[$i]['quantite'] = $request->quantite[$i];
                $details_list[$i]['total_quantite'] = $request->total_quantite[$i];
                $details_list[$i]['prix_unitaire'] = $request->prix_unitaire[$i];
                $details_list[$i]['prix_total'] = $request->prix_total[$i];

                $stock = DB::table('articles')->select('stock')->where('reference', $request->article[$i])->value('stock');
                $stock1 = $stock + $request->quantite[$i];
                DB::table('articles')->where('reference', $request->article[$i])->update(['stock' => $stock1]);
             
                $sum_prix_unitaire = DB::table('arivages')->where('article', $request->article[$i])->sum('prix_unitaire');
                $count = DB::table('arivages')->where('article', $request->article[$i])->count();
                $avg = $sum_prix_unitaire / $count ;

                DB::table('articles')->where('reference', $request->article[$i])->update(['avg' => $avg]);
            }

            $bonEntree->bons()->createMany($details_list);          
            session()->flash('Add', 'تم الحفظ بنجاح');
            //return back();
            return redirect()->route('bonEntrees.index');

        // }

        // catch (\Exception $e){
        //     return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        // }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BonEntree  $bonEntree
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bonEntrees = BonEntree::findOrFail($id);
        return view('bonEntrees.show' , compact('bonEntrees'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BonEntree  $bonEntree
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bonEntrees = BonEntree::where('id', $id)->first();
        $articles = Article::all();
        return view('bonEntrees.editBon', compact('bonEntrees','articles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BonEntree  $bonEntree
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       // return $request;

        // try {

            // $this->validate($request,[
            //     'bon_number' => 'required|unique:bon_entrees|max:15',
            //     'bon_date' => 'required',
            //     'client_name' => 'required',
            //     //'article.*' => 'required',
            //     'quantite.*' => 'required',
            //     'prix_unitaire.*' => 'required'
            // ]);


            $bonEntree = BonEntree::whereId($id)->first();

            $data['bon_number'] = $request->bon_number;
            $data['bon_date'] = $request->bon_date;
            $data['client_name'] = $request->client_name;
            $data['total'] = $request->total;
            $data['created_by'] = Auth::user()->name;

           
            //dd($bonEntree->id);
            $count = EntreeDetail::where('bon_entrees_id' , $id)->get()->count('article');
            $bonEntree->update($data);
            $bonEntree->bons()->delete();

            $details_list = [];
               
            //dd($count);
            for ($i = 0; $i < $count; $i++) {

                $desc[$i] = Article::whereId($request->descriptionn[$i])->first();

                $details_list[$i]['article'] = $request->description[$i];
                $details_list[$i]['description'] =  $desc[$i];
                $details_list[$i]['quantite'] = $request->quantite[$i];
                $details_list[$i]['prix_unitaire'] = $request->prix_unitaire[$i];
                $details_list[$i]['prix_total'] = $request->prix_total[$i];
                $details_list[$i]['total_quantite'] = $request->quantite[$i];;

                $stock = DB::table('articles')->select('stock')->where('reference', $request->article[$i])->value('stock');
                $stock1 = $stock + $request->quantite[$i];
                DB::table('articles')->where('reference', $request->article[$i])->update(['stock' => $stock1]);
            }
           
            //dd($bonEntree->id );
            $bonEntree->bons()->createMany($details_list);           
            // $bonEntree->bons()->update($details_list);
            //dd('ok');
            // $stock = DB::table('articles')->select('stock')->where('reference', $request->article)->value('stock');
            // $stock1 = $stock + array_sum($request->quantite);
            // DB::table('articles')->where('reference', $request->article)->update(['stock' => $stock1]);

            session()->flash('edit', 'تم التعديل بنجاح');
            return redirect()->route('bonEntrees.index');

        // }

        // catch (\Exception $e){
        //     return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        // }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BonEntree  $bonEntree
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        //dd($request);

        $id =  $request->bon_id;
        $bonEntree = BonEntree::where('id' , $id)->first();
        //$bonEntree = BonEntree::findOrFail($id);
        //dd($bonEntree);
        $page_id = $request->page_id;
        if(!$page_id == 2){
        
            $bonEntree->forceDelete();
            session()->flash('delete', 'تمت عملية الحذف بنجاح ');
            return redirect()->route('bonEntrees.index');

        }else {
            $bonEntree->delete();
            session()->flash('archive', 'تمت عملية الأرشفة بنجاح');
            return redirect()->route('bonEntrees.index');
        } 

    }

    public function getproducts($id)
    {
        $articles = DB::table("articles")->where("categorie_id", $id)->pluck("reference", "id");
        return json_encode($articles);
    }
}
