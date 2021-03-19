<?php

namespace App\Http\Controllers;

//use App\Events\CommandeNotif;
use App\Models\Article;
use App\Models\Client;
use App\Models\Commande;
use App\Models\User;
use App\Notifications\CommandeNotif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bonCommandes = Commande::all();
        return view('commande.list' , compact('bonCommandes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bons = Commande::all();
        $nbRow = count( $bons) + 1;
        if( $nbRow < 10 ) {
            $bc_number = 'BC'.'-'.date('Y')."000".$nbRow;
        }elseif ($nbRow >= 10 && $nbRow <= 99){
            $bc_number = 'BC' . '-'.date('Y')."00".$nbRow;
        }elseif ($nbRow >= 100 ){
            $bc_number = 'BC' . '-'.date('Y')."0".$nbRow;
        }
        $bon_number = $bc_number;
        $articles = Article::all();
        $clients = Client::all();
        return view('commande.create' , compact('articles', 'clients' ,'bon_number'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $this->validate($request,[
            'bon_number' => 'required|unique:commandes|max:15',
            'client_name' => 'required',
           // 'client_credit' => 'required',
            'article.*' => 'required',
            'quantite.*' => 'required',
        ]);

        

        $bons = Commande::all();
        $nbRow = count( $bons) + 1;
        if( $nbRow < 10 ) {
            $bl_number = 'BC'.'-'.date('Y')."000".$nbRow;
        }elseif ($nbRow >= 10 && $nbRow <= 99){
            $bl_number = 'BC' . '-'.date('Y')."00".$nbRow;
        }elseif ($nbRow >= 100 ){
            $bl_number = 'BC' . '-'.date('Y')."0".$nbRow;
        }


        $data['bon_number'] = $bl_number;
        //$data['bon_number'] = $request->bon_number;
        //$data['bon_date'] = $request->bon_date;
        $data['client_name'] = $request->client_name;
       // $data['client_credit'] = $request->client_credit;
        $data['created_by'] = Auth::user()->name;


        $bonCommande = Commande::create($data);

        $details_list = [];

        for ($i = 0; $i < count($request->article); $i++) {

                $details_list[$i]['article'] = $request->article[$i];
                $details_list[$i]['description'] = $request->description[$i];
                $details_list[$i]['unite_mesure'] = $request->unite_mesure[$i];
                $details_list[$i]['quantite'] = $request->quantite[$i];

        }

        $details = $bonCommande->bons()->createMany($details_list);
        
        $user = User::get();
        $user = User::find(Auth::user()->id);

        $commande = Commande::latest()->first()->id;
        //$commande= Commande::where('bon_number', $request->article)->first();
        //$commande = Commande::where('id', $request->id)->get();
        //event(new CommandeNotif($data));
        Notification::send($user ,new CommandeNotif($commande));

        session()->flash('Add', 'تم الحفظ بنجاح');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bonCommandes = Commande::findOrFail($id);
        $clients = Commande::where('id' ,$id)->get();
        return view('commande.show' , compact('bonCommandes','clients'));
    }
    public function getDetail($id)
    {
        $bonCommandes = Commande::findOrFail($id);
        $clients = Commande::where('id' ,$id)->get();
        return view('commande.show' , compact('bonCommandes','clients'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function edit(Commande $commande)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commande $commande)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commande $commande)
    {
        //
    }

    public function MarkAsRead(){

        $userUnreadNotifications = auth()->user()->unreadNotifications->where('type' , 'App\Notifications\CommandeNotif');

        if($userUnreadNotifications){
            $userUnreadNotifications->markAsRead();
            return back();
        }

    }
}
