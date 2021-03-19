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
use App\Helpers\Helper;
use App\Models\Client;

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
        $bons = BonSortie::all();
        $nbRow = count( $bons) + 1;
        if( $nbRow < 10 ) {
            $bl_number = 'BL'.'-'.date('Y')."000".$nbRow;
        }elseif ($nbRow >= 10 && $nbRow <= 99){
            $bl_number = 'BL' . '-'.date('Y')."00".$nbRow;
        }elseif ($nbRow >= 100 ){
            $bl_number = 'BL' . '-'.date('Y')."0".$nbRow;
        }
        //$bon_number = DB::table('bon_sorties')->latest('bon_number')->first();
        $bon_number = $bl_number;
        $articles = Article::all();
        $clients = Client::all();
        return view('bonSorties.creeBon',compact('articles','bon_number' , 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'bon_number' => 'required|unique:bon_sorties|max:15',
            'bon_date' => 'required',
            'client_name' => 'required',
            'client_address' => 'required',
            'article' => 'required',
            'quantite' => 'required',
            'prix_unitaire' => 'required'
        ]);

        

        $bons = BonSortie::all();
        $nbRow = count( $bons) + 1;
        if( $nbRow < 10 ) {
            $bl_number = 'BL'.'-'.date('Y')."000".$nbRow;
        }elseif ($nbRow >= 10 && $nbRow <= 99){
            $bl_number = 'BL' . '-'.date('Y')."00".$nbRow;
        }elseif ($nbRow >= 100 ){
            $bl_number = 'BL' . '-'.date('Y')."0".$nbRow;
        }


        $data['bon_number'] = $bl_number;
        //$data['bon_number'] = $request->bon_number;
        $data['bon_date'] = $request->bon_date;
        $data['client_name'] = $request->client_name;
        $data['client_address'] = $request->client_address;
        $data['client_phone'] = $request->client_phone;
        $data['total'] = $request->total;
        $data['created_by'] = Auth::user()->name;


        $bonSortie = BonSortie::create($data);

        $details_list = [];

        for ($i = 0; $i < count($request->article); $i++) {

           // $stock = DB::table('articles')->select('stock')->where('reference', $request->article[$i])->value('stock');

            // try{

                //$stock = [];

                $details_list[$i]['article'] = $request->article[$i];
                $details_list[$i]['description'] = $request->description[$i];
                $details_list[$i]['quantite'] = $request->quantite[$i];
                $details_list[$i]['total_quantite'] = $request->total_quantite[$i];
                $details_list[$i]['prix_unitaire'] = $request->prix_unitaire[$i];
                $details_list[$i]['prix_total'] = $request->prix_total[$i];

            try {
                $stock= DB::table('articles')->select('stock')->where('reference', $request->article[$i])->value('stock');
                //dd($stock[$i]);
                $stock1 = $stock - $request->quantite[$i];
                DB::table('articles')->where('reference', $request->article[$i])->update(['stock' => $stock1]);
        
            }
            catch (\Exception $e){
                    return redirect()->back()->withErrors(['error' => 'المرجو حذف هذه الفاتورة من الجدول و التأكد من المخزن !!']);
            }
            // }

            // catch (\Exception $e){
            //     return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            // }
        }

        $details = $bonSortie->bons()->createMany($details_list);
        
        $user = User::get();
        $user = User::find(Auth::user()->id);
        $article= Article::where('reference', $request->article)->first();

        if($stock1 < 10 ){
           Notification::send($user ,new CheckStock($article));
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
        dd($request);
        $this->validate($request,[
            'bon_number' => 'required|unique:bon_sorties|max:15',
            'bon_date' => 'required',
            'client_name' => 'required',
            'client_address' => 'required',
            'client_phone' => 'required|max:10|min:10',
            'article' => 'required',
            'quantite' => 'required',
            'prix_unitaire' => 'required'
        ]);
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
                $details_list[$i]['description'] = $request->description[$i];
                $details_list[$i]['quantite'] = $request->quantite[$i];
                $details_list[$i]['total_quantite'] = $request->total_quantite[$i];
                $details_list[$i]['prix_unitaire'] = $request->prix_unitaire[$i];
                $details_list[$i]['prix_total'] = $request->prix_total[$i];

                $stock = DB::table('articles')->select('stock')->where('reference', $request->article[$i])->value('stock');
                $stock1 = $stock - $request->quantite[$i];
                DB::table('articles')->where('reference', $request->article[$i])->update(['stock' => $stock1]);
            }
      

       // (is_countable($admin)?$admin:[])
        $details = $bonSortie->bons()->createMany($details_list);

        // $stock = DB::table('articles')->select('stock')->where('reference', $request->article)->value('stock');
        // $stock1 = $stock - array_sum($request->quantite);
        // DB::table('articles')->where('reference', $request->article)->update(['stock' => $stock1]);
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
        //return $request->all();
        $id =  $request->bon_id;
        $bonSortie = BonSortie::where('id' , $id)->first();
        $page_id = $request->page_id;
        if(!$page_id == 2){
        
            $bonSortie->forceDelete();
            session()->flash('delete', 'تمت عملية الحذف بنجاح');
            return redirect()->route('bonSorties.index');

        }else {
            $bonSortie->delete();
            session()->flash('archive', 'تمت عملية الأرشفة بنجاح');
            return redirect()->route('bonSorties.index');
        } 
    }



    public function print($id){
        $bonSorties = BonSortie::where('id',$id)->first();
        return view('bonSorties.show',compact('bonSorties'));
    }

    public function getStock($ref)
    {
        $stock = DB::table('articles')->select('stock')->where('reference', $ref)->first();
        //$clients = DB::table("clients")->where("full_name", $ref)->first();
        return json_encode($stock);
    }


    public function getDescription($reference)
    {
        $reference = DB::table("articles")->where("reference", $reference)->first();
        return json_encode($reference);
    }

}
