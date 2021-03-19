<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{

    // function __construct()
    // {
    //     //$this->middleware('permission:view role', ['only' => ['index', 'store']]);
    //     $this->middleware('permission:add categorie', ['only' => ['create', 'store']]);
    //     $this->middleware('permission:edit categorie', ['only' => ['edit', 'update']]);
    //     $this->middleware('permission:delete categorie', ['only' => ['destroy']]);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categorie::all();
        return view('categories.list',compact('categories'));
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
    public function store(Request $request, Categorie $categorie)
    {

        try {

            $this->validate($request,[
                'categorie_name' => 'required|unique:categories|max:255',
            ]);
    
            $categorie->categorie_name = $request->input('categorie_name');
            $categorie->created_By = Auth::user()->name;
            $categorie->save();
            session()->flash('success', 'تم الحفظ بنجاح');
            return redirect('/categories');

        }

        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
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
        
        try {

            $id = $request->id;
            $this->validate($request,[
                'categorie_name' => 'required|max:255|unique:categories,categorie_name,'.$id,
            ]);

            $categorie = Categorie::find($id);
            $categorie->categorie_name = $request->input('categorie_name');
            $categorie->save();

            session()->flash('success','تم التعديل بنجاح');
            return redirect('/categories');
        }

        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy (Request $request)
    {
        $id = $request->id;
        $categorie = Categorie::find($id);
        $categorie->delete();
        session()->flash('success', 'تمت عملية الحذف بنجاح');
        return redirect('/categories');
    }
}
