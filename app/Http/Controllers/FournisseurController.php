<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use App\Models\Fournisseur as ModelsFournisseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FournisseurController extends Controller
{

    // function __construct()
    // {
    //     $this->middleware('permission:fournisseurs list', ['only' => ['index']]);
    //     $this->middleware('permission:add fournisseur', ['only' => ['create', 'store']]);
    //     $this->middleware('permission:edit fournisseur', ['only' => ['edit', 'update']]);
    //     $this->middleware('permission:delete fournisseur', ['only' => ['destroy']]);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fournisseurs = Fournisseur::all();
        return view('Fournisseur.list', compact('fournisseurs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , fournisseur $fournisseur)
    {
        //try {
            $this->validate($request,[
                'full_name' => 'required|unique:fournisseurs|max:50',
                'address' => 'required'
               // 'phone' => 'required'
            ]);

            $fournisseur->full_name = $request->input('full_name');
            $fournisseur->address = $request->input('address');
            $fournisseur->phone = $request->input('phone');
            $fournisseur->email = $request->input('email');
            $fournisseur->save();
            session()->flash('success', 'تم الحفظ بنجاح');
            return redirect('/fournisseurs');
        // }

        // catch (\Exception $e){
        //     return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function show(fournisseur $fournisseur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function edit(fournisseur $fournisseur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request , $id)
    {

       // try {

            $id = $request->id;
            // $this->validate($request,[
            //     'full_name' => 'required|unique:fournisseurs|max:50'.$id,
            //     'address' => 'required'
            // ]);

            $fournisseur = Fournisseur::find($id);
            $fournisseur->full_name = $request->input('full_name');
            $fournisseur->address = $request->input('address');
            $fournisseur->phone = $request->input('phone');
            $fournisseur->email = $request->input('email');
            $fournisseur->save();

            session()->flash('success','تم التعديل بنجاح');
            return redirect('/fournisseurs');
        // }

        // catch (\Exception $e){
        //     return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $fournisseur = Fournisseur::find($id);
        $fournisseur->delete();
        session()->flash('success', 'تمت عملية الحذف بنجاح');
        return redirect('/fournisseurs');
    }


    public function getFournisseur($name)
    {
        $fournisseurs = DB::table("fournisseurs")->where("full_name", $name)->first();
        return json_encode($fournisseurs);
    }
}
