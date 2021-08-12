<?php

namespace App\Http\Controllers;

use App\Models\BonSortie;
use App\Models\Credit;
use Illuminate\Http\Request;

class CreditController extends Controller
{

    // function __construct()
    // {
    //     $this->middleware('permission:credit', ['only' => ['index','suiviDetails' , 'suivi']]);
    //     $this->middleware('permission:edit credit', ['only' => ['update']]);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $credits = Credit::all();
        return view('credit.list' , compact('credits'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Credit  $credit
     * @return \Illuminate\Http\Response
     */
    public function show(Credit $credit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Credit  $credit
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //dd($id);
        $credit = Credit::find($id);
        return view('credit.edit',compact('credit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Credit  $credit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       // return $request;
        //dd($request);
        try {

            //$id = $request->id;

            $credit = Credit::find($id);
            $credit->credit = $request->input('rest');
            $credit->save();

            session()->flash('success','تم التعديل بنجاح');
            return redirect()->route('credits.index');
        }

        catch (\Exception $e){
            return redirect()->route('credits.index')->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Credit  $credit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Credit $credit)
    {
        //
    }

    // for bon Sorties lients
    public function suivi($code)
    {
        $sum = BonSortie::where('code_client' , $code)->sum('rest');
        $bon_sorties = BonSortie::where('code_client' , $code)->get();
        return view('credit.details',compact('bon_sorties','sum'));
    }

    // for Details of bon Sorties lients
    public function suiviDetails($id)
    {
        $bon_sorties = BonSortie::findOrFail($id);;
        return view('credit.show',compact('bon_sorties'));
    }

}
