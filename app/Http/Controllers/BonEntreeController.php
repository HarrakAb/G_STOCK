<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\BonEntree;
use App\Models\Categorie;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BonEntreeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bonEntrees = BonEntree::orderBy('id' , 'desc')->paginate(5);
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
        }elseif ($nbRow >= 100 ){
            $bl_number = 'BR' . '-'.date('Y')."0".$nbRow;
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

        try {

            $this->validate($request,[
                'bon_number' => 'required|unique:bon_entrees|max:15',
                'bon_date' => 'required',
                'client_name' => 'required',
                'article.*' => 'required',
                'quantite.*' => 'required',
                'prix_unitaire.*' => 'required',
            ]);

            $bons = BonEntree::all();
            $nbRow = count( $bons) + 1;
            if( $nbRow < 10 ) {
                $bl_number = 'BR'.'-'.date('Y')."000".$nbRow;
            }elseif ($nbRow >= 10 && $nbRow <= 99){
                $bl_number = 'BR' . '-'.date('Y')."00".$nbRow;
            }elseif ($nbRow >= 100 ){
                $bl_number = 'BR' . '-'.date('Y')."0".$nbRow;
            }

            $data['bon_number'] = $bl_number;
            $data['bon_date'] = $request->bon_date;
            $data['client_name'] = $request->client_name;
            $data['total'] = $request->total;
            $data['created_by'] = Auth::user()->name;


            $bonEntree = BonEntree::create($data);

            $details_list = [];
            for ($i = 0; $i < count($request->article); $i++) {
                $details_list[$i]['article'] = $request->article[$i];
                $details_list[$i]['description'] = $request->description[$i];
                $details_list[$i]['quantite'] = $request->quantite[$i];
                $details_list[$i]['total_quantite'] = $request->total_quantite[$i];
                $details_list[$i]['prix_unitaire'] = $request->prix_unitaire[$i];
                $details_list[$i]['prix_total'] = $request->prix_total[$i];


                $stock = DB::table('articles')->select('stock')->where('reference', $request->article[$i])->value('stock');
                $stock1 = $stock + $request->quantite[$i];
                DB::table('articles')->where('reference', $request->article[$i])->update(['stock' => $stock1]);
            }

            $bonEntree->bons()->createMany($details_list);

            // $stock = DB::table('articles')->select('stock')->where('reference', $request->article)->value('stock');
            // $stock += array_sum($request->quantite);
            // DB::table('articles')->where('reference', $request->article)->update(['stock' => $stock]);

            
            session()->flash('Add', 'تم الحفظ بنجاح');
            //return back();
            return redirect()->route('bonEntrees.index');

        }

        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

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

        try {

            $this->validate($request,[
                'bon_number' => 'required|unique:bon_entrees|max:15',
                'bon_date' => 'required',
                'client_name' => 'required',
                'article.*' => 'required',
                'quantite.*' => 'required',
                'prix_unitaire.*' => 'required'
            ]);


            $bonEntree = BonEntree::whereId($id)->first();

            $data['bon_number'] = $request->bon_number;
            $data['bon_date'] = $request->bon_date;
            $data['client_name'] = $request->client_name;
            $data['total'] = $request->total;
            $data['created_by'] = Auth::user()->name;

            $bonEntree->update($data);
            $bonEntree->bons()->delete();

            $details_list = [];


                
            for ($i = 0; $i < count(array($request->article)); $i++) {
                $details_list[$i]['article'] = $request->article[$i];
                $details_list[$i]['description'] = $request->description[$i];
                $details_list[$i]['quantite'] = $request->quantite[$i];
                $details_list[$i]['total_quantite'] = $request->total_quantite[$i];
                $details_list[$i]['prix_unitaire'] = $request->prix_unitaire[$i];
                $details_list[$i]['prix_total'] = $request->prix_total[$i];

                $stock = DB::table('articles')->select('stock')->where('reference', $request->article[$i])->value('stock');
                $stock1 = $stock + $request->quantite[$i];
                DB::table('articles')->where('reference', $request->article[$i])->update(['stock' => $stock1]);
            }
    
            $details = $bonEntree->bons()->createMany($details_list);

            // $stock = DB::table('articles')->select('stock')->where('reference', $request->article)->value('stock');
            // $stock1 = $stock + array_sum($request->quantite);
            // DB::table('articles')->where('reference', $request->article)->update(['stock' => $stock1]);

            session()->flash('edit', 'تم التعديل بنجاح');
            return redirect()->route('bonEntrees.index');

        }

        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

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
