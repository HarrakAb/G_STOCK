<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Bons;
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
        $bonSorties = BonSortie::orderBy('id' , 'desc')->paginate(5);
        return view('bonSorties.listBon',compact('bonSorties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $articles = Article::all();
        return view('bonSorties.creeBon',compact('articles'));
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
        $data['client_address'] = $request->client_address;
        $data['client_phone'] = $request->client_phone;
        $data['total'] = $request->total;
        $data['created_by'] = Auth::user()->name;


        $bonSortie = BonSortie::create($data);

        $details_list = [];
        for ($i = 0; $i < count($request->article); $i++) {
            $details_list[$i]['article'] = $request->article[$i];
            $details_list[$i]['quantite'] = $request->quantite[$i];
            $details_list[$i]['prix_unitaire'] = $request->prix_unitaire[$i];
            $details_list[$i]['prix_total'] = $request->prix_total[$i];
        }

        $details = $bonSortie->bons()->createMany($details_list);

        $stock = DB::table('articles')->select('stock')->where('reference', $request->article)->value('stock');
        $stock1 = $stock - array_sum($request->quantite);
        DB::table('articles')->where('reference', $request->article)->update(['stock' => $stock1]);
        

        
        $user = User::get();
        $user = User::find(Auth::user()->id);
        $article= Article::where('reference', $request->article)->first();

        if($stock1 < 10 ){
           Notification::send($user ,new CheckStock($article));
           session()->flash('stock', 'verifié votre stock !');
        }

        //dd($article->reference);

        if( $stock < 10 ) {

            $user = User::get();
            Notification::send(new CheckStock($article));
           session()->flash('stock', 'المرجو التأكد من المخزن !!');
        }
        
        session()->flash('Add', 'تم الحفظ بنجاح');
        return redirect()->route('bonSorties.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BonSortie  $bonSortie
     * @return \Illuminate\Http\Response
     */
    public function show(BonSortie $bonSortie , $id)
    {
        $bonSorties = BonSortie::findOrFail($id);
        return view('bonSorties.show' , compact('bonSorties'));
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
        $articles = Article::all();
        return view('bonSorties.editBon', compact('bonSorties','articles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BonSortie  $bonSortie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request);
        //return $request->all();
        $bonSortie = BonSortie::whereId($id)->first();

        $data['bon_number'] = $request->bon_number;
        $data['bon_date'] = $request->bon_date;
        $data['client_name'] = $request->client_name;
        $data['client_address'] = $request->client_address;
        $data['client_phone'] = $request->client_phone;
        $data['total'] = $request->total;
        $data['created_by'] = Auth::user()->name;

        $bonSortie->update($data);
        $bonSortie->bons()->delete();

        //dump(count($request->article));
        $details_list = [];

            
            for ($i = 0; $i < count(array($request->article)); $i++) {
                $details_list[$i]['article'] = $request->article[$i];
                $details_list[$i]['quantite'] = $request->quantite[$i];
                $details_list[$i]['prix_unitaire'] = $request->prix_unitaire[$i];
                $details_list[$i]['prix_total'] = $request->prix_total[$i];
            }
      

       // (is_countable($admin)?$admin:[])
        $details = $bonSortie->bons()->createMany($details_list);

        $stock = DB::table('articles')->select('stock')->where('reference', $request->article)->value('stock');
        $stock1 = $stock - array_sum($request->quantite);
        DB::table('articles')->where('reference', $request->article)->update(['stock' => $stock1]);
        //dump( array_sum($request->quantite));

        session()->flash('edit', 'تم التعديل بنجاح');
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
            session()->flash('success', 'تمت عملية الحذف بنجاح');
            return redirect()->route('bonSorties.index');

        }else {
            $bonEntree->delete();
            session()->flash('success', 'تمت عملية الأرشفة بنجاح');
            return redirect()->route('bonSorties.index');
        } 
    }



    public function print($id){
        $bonSorties = BonSortie::where('id',$id)->first();
        return view('bonSorties.show',compact('bonSorties'));
    }


}
