<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientsController extends Controller
{

    // function __construct()
    // {
    //     $this->middleware('permission:clients list', ['only' => ['index']]);
    //     $this->middleware('permission:add client', ['only' => ['create', 'store']]);
    //     $this->middleware('permission:edit client', ['only' => ['edit', 'update']]);
    //     $this->middleware('permission:delete client', ['only' => ['destroy']]);
    //     $this->middleware('permission:add bon', ['only' => ['getClient']]);
    //     $this->middleware('permission:add commande', ['only' => ['getCredit']]);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        return view('clients.list', compact('clients'));
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
    public function store(Request $request, Client $client)
    {
        // try {
        $this->validate($request, [
            'full_name' => 'required|unique:clients|max:50',
            'address' => 'required'
        ]);

        $clients = Client::all();
        $nbRow = count($clients) + 1;
        if ($nbRow < 10) {
            $bl_number = 'CL' . '-' . "000" . $nbRow;
        } elseif ($nbRow >= 10 && $nbRow <= 99) {
            $bl_number = 'CL' . '-' . "00" . $nbRow;
        } elseif ($nbRow > 99) {
            $bl_number = 'CL' . '-' . "0" . $nbRow;
        }
        $client->code_client = $bl_number;
        $client->full_name = $request->input('full_name');
        $client->address = $request->input('address');
        $client->phone = $request->input('phone');
        $client->email = $request->input('email');
        $client->save();
        session()->flash('success', 'تم الحفظ بنجاح');
        return redirect('/clients');
        // }

        // catch (\Exception $e){
        //     return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //try {

        $id = $request->id;
        $this->validate($request, [
            'full_name' => 'required|unique:clients|max:50' . $id,
            'address' => 'required'
        ]);

        $client = Client::find($id);
        $client->full_name = $request->input('full_name');
        $client->address = $request->input('address');
        $client->phone = $request->input('phone');
        $client->email = $request->input('email');
        $client->save();

        session()->flash('success', 'تم التعديل بنجاح');
        return redirect('/clients');
        //}

        // catch (\Exception $e){
        //     return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        // }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $client = Client::find($id);
        $client->delete();
        session()->flash('success', 'تمت عملية الحذف بنجاح');
        return redirect('/clients');
    }

    public function getClient($name)
    {
        $clients = DB::table("clients")->where("full_name", $name)->first();
        return json_encode($clients);
    }

    public function searchClient($search)
    {
        $results = DB::table("clients")->where("full_name", 'LIKE', '%' . $search . '%')->get();
        return json_decode($results);
    }

    public function getCredit($code)
    {
        $credit = DB::table("credits")->where("code_client", $code)->first();
        return json_encode($credit);
    }
}
