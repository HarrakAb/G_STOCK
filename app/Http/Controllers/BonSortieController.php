<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\BonSortie;
use App\Models\Categorie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CheckStock;

class BonSortieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bonSorties = BonSortie::all();
        return view('bonSorties.listBon',compact('bonSorties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categorie::all();
        return view('bonSorties.creeBon',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $article= Article::where('reference', $request->article)->first();
        // dd($article);
        BonSortie::create([
            'bon_number' => $request->bon_number,
            'bon_date' => $request->bon_date,
            'article' => $request->article,
            'categorie_id' => $request->categorie,
            'quantite' => $request->quantite,
            'prix_unitaire' => $request->prix_unitaire,
            'prix_total' => $request->prix_total,
            'created_by' => $request->created_by = Auth::user()->name,
        ]);

        
        $stock = DB::table('articles')->select('stock')->where('reference', $request->article)->value('stock');
        $stock1 = $stock - $request->quantite;
        DB::table('articles')->where('reference', $request->article)->update(['stock' => $stock1]);
        

        
        $user = User::get();
        //$user = User::find(Auth::user()->id);
        $article= Article::where('reference', $request->article)->first();
        if($stock1 < 10 ){
            Notification::send($user ,new CheckStock($article));
            session()->flash('stock', 'verifié votre stock !');
        }

        //dd($article->reference);

        //if( $stock < 10 ) {

            //$user = User::get();
            //Notification::send(new CheckStock($article));
           // session()->flash('stock', 'Veuillez Verifié Votre Stock !!');
        //}
        
        session()->flash('Add', 'Bon crée avec succés');
        return redirect()->route('bonSorties.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BonSortie  $bonSortie
     * @return \Illuminate\Http\Response
     */
    public function show(BonSortie $bonSortie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BonSortie  $bonSortie
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bonSorties = BonSortie::where('id', $id)->first();
        $categories = Categorie::all();
        return view('bonSorties.editBon', compact('bonSorties','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BonSortie  $bonSortie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BonSortie $bonSortie)
    {
        //dd($request->bonSortie_id);
        $bonSortie = BonSortie::findOrFail($request->bonSortie_id);
        $bonSortie->update([
            'bon_number' => $request->bon_number,
            'bon_date' => $request->bon_date,
            'article' => $request->article,
            'categorie_id' => $request->categorie,
            'quantite' => $request->quantite,
            'prix_unitaire' => $request->prix_unitaire,
            'prix_total' => $request->prix_total,
            'created_by' => $request->created_by = Auth::user()->name,
        ]);

        session()->flash('edit', 'Bon modifier avec success');
        return redirect()->route('bonSorties.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BonSortie  $bonSortie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id =  $request->bon_id;
        $bonEntree = BonSortie::where('id' , $id)->first();
        $page_id = $request->page_id;
        if(!$page_id == 2){
        
            $bonEntree->forceDelete();
            session()->flash('success', 'suppression effectuée');
            return redirect()->route('bonEntrees.index');

        }else {
            $bonEntree->delete();
            session()->flash('success', 'archivage effectuée');
            return redirect()->route('bonEntrees.index');
        } 
    }



    public function print($id){
        $bonSorties = BonSortie::where('id',$id)->first();
        return view('bonSorties.print',compact('bonSorties'));
    }


}
