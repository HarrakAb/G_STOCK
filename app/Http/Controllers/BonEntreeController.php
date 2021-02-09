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
        $categories = Categorie::all();
        return view('bonEntrees.creeBon',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        // $stock = Article::select('stock')->where('reference', $request->article)->get();
        // dd($stock);
       // dump($request);
        BonEntree::create([
            'bon_number' => $request->bon_number,
            'bon_date' => $request->bon_date,
            'article' => $request->article,
            'categorie_id' => $request->categorie,
            'quantite' => $request->quantite,
            'prix_unitaire' => $request->prix_unitaire,
            'prix_total' => $request->prix_total,
            'created_by' => $request->created_by = Auth::user()->name,
            'received_by' => $request->received_by
        ]);

        $stock = DB::table('articles')->select('stock')->where('reference', $request->article)->value('stock');
        $stock += $request->quantite;
        DB::table('articles')->where('reference', $request->article)->update(['stock' => $stock]);

        

        // $invoice_id = Invoice::latest()->first()->id;
        // Invoices_Details::create([
        //     'id_Invoice' => $invoice_id,
        //     'invoice_number' => $request->invoice_number,
        //     'article' => $request->article,
        //     'categorie' => $request->categorie,
        //     'Status' => 'غير مدفوعة',
        //     'Value_Status' => 2,
        //     'note' => $request->note,
        //     'user' => (Auth::user()->name),
        // ]);

        // if ($request->hasFile('pic')) {

        //     $invoice_id = Invoice::latest()->first()->id;
        //     $image = $request->file('pic');
        //     $file_name = $image->getClientOriginalName();
        //     $invoice_number = $request->invoice_number;

        //     $attachments = new Invoices_Attachment();
        //     $attachments->file_name = $file_name;
        //     $attachments->invoice_number = $invoice_number;
        //     $attachments->Created_by = Auth::user()->name;
        //     $attachments->invoice_id = $invoice_id;
        //     $attachments->save();

        //     // move pic
        //     $imageName = $request->pic->getClientOriginalName();
        //     $request->pic->move(public_path('Attachments/' . $invoice_number), $imageName);
        // }

         
        // $user = User::first();
        // Notification::send($user, new AddInvoice($invoice_id));


        
        session()->flash('Add', 'Bon crée avec succés');
        //return back();
        return redirect()->route('bonEntrees.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BonEntree  $bonEntree
     * @return \Illuminate\Http\Response
     */
    public function show(BonEntree $bonEntree)
    {
        //
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
        $categories = Categorie::all();
        return view('bonEntrees.editBon', compact('bonEntrees','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BonEntree  $bonEntree
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BonEntree $bonEntree)
    {
        //dd($request->bonEntree_id);
        $bonEntree = BonEntree::findOrFail($request->bonEntree_id);
        $bonEntree->update([
            'bon_number' => $request->bon_number,
            'bon_date' => $request->bon_date,
            'article' => $request->article,
            'categorie_id' => $request->categorie,
            'quantite' => $request->quantite,
            'prix_unitaire' => $request->prix_unitaire,
            'prix_total' => $request->prix_total,
            'created_by' => $request->created_by = Auth::user()->name,
            'received_by' => $request->received_by,

        ]);

        //dd($bonEntree);

        session()->flash('edit', 'Bon modifier avec success');
        //return back();
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
            session()->flash('success', 'suppression effectuée ');
            return redirect()->route('bonEntrees.index');

        }else {
            $bonEntree->delete();
            session()->flash('success', 'archivage effectuée');
            return redirect()->route('bonEntrees.index');
        } 

    }

    public function getproducts($id)
    {
        $articles = DB::table("articles")->where("categorie_id", $id)->pluck("reference", "id");
        return json_encode($articles);
    }
}
