<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\BonEntree;
use App\Models\Categorie;
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
        $bonEntrees = BonEntree::all();
        return view('bonEntrees.listBon',compact('bonEntrees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $articles = Article::all();
        return view('bonEntrees.creeBon',compact('articles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data['bon_number'] = $request->bon_number;
        $data['bon_date'] = $request->bon_date;
        $data['client_name'] = $request->client_name;
        $data['total'] = $request->total;
        $data['created_by'] = Auth::user()->name;


        $bonEntree = BonEntree::create($data);

        $details_list = [];
        for ($i = 0; $i < count($request->article); $i++) {
            $details_list[$i]['article'] = $request->article[$i];
            $details_list[$i]['quantite'] = $request->quantite[$i];
            $details_list[$i]['prix_unitaire'] = $request->prix_unitaire[$i];
            $details_list[$i]['prix_total'] = $request->prix_total[$i];
        }

        $details = $bonEntree->bons()->createMany($details_list);

        $stock = DB::table('articles')->select('stock')->where('reference', $request->article)->value('stock');
        $stock += array_sum($request->quantite);
        DB::table('articles')->where('reference', $request->article)->update(['stock' => $stock]);

        
        session()->flash('Add', 'تم الحفظ بنجاح');
        //return back();
        return redirect()->route('bonEntrees.index');

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
            $details_list[$i]['quantite'] = $request->quantite[$i];
            $details_list[$i]['prix_unitaire'] = $request->prix_unitaire[$i];
            $details_list[$i]['prix_total'] = $request->prix_total[$i];
        }
  
        $details = $bonEntree->bons()->createMany($details_list);

        $stock = DB::table('articles')->select('stock')->where('reference', $request->article)->value('stock');
        $stock1 = $stock + array_sum($request->quantite);
        DB::table('articles')->where('reference', $request->article)->update(['stock' => $stock1]);

        session()->flash('edit', 'تم التعديل بنجاح');
        return redirect()->route('bonEntrees.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BonEntree  $bonEntree
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        //dd($request);

        $id =  $request->bon_id;
        $bonEntree = BonEntree::where('id' , $id)->first();
        $page_id = $request->page_id;
        if(!$page_id == 2){
        
            $bonEntree->forceDelete();
            session()->flash('success', 'تمت عملية الحذف بنجاح ');
            return redirect()->route('bonEntrees.index');

        }else {
            $bonEntree->delete();
            session()->flash('success', 'تمت عملية الأرشفة بنجاح');
            return redirect()->route('bonEntrees.index');
        } 

    }

    public function getproducts($id)
    {
        $articles = DB::table("articles")->where("categorie_id", $id)->pluck("reference", "id");
        return json_encode($articles);
    }
}
