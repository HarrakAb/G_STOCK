<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\BonEntree;
use App\Models\BonSortie;
use App\Models\Categorie;
use App\Models\EntreeDetail;
use App\Models\SortieDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;


class ArticlesController extends Controller
{


    // function __construct()
    // {
    //     $this->middleware('permission:articles', ['only' => ['index']]);
    //     $this->middleware('permission:add article', ['only' => ['create', 'store']]);
    //     $this->middleware('permission:edit article', ['only' => ['edit', 'update']]);
    //     $this->middleware('permission:delete article', ['only' => ['destroy']]);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categorie::all();
        $articles = Article::all();
        return view('articles.list',compact('categories','articles'));
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
    public function store(Request $request, Article $article)
    {
        //return $request;
        try {
            $this->validate($request,[
                'reference' => 'required|unique:articles|max:255',
                'unite_mesure' => 'required',
                'description' => 'required|unique:articles|max:255',
                'categorie_id' => 'required'
            ]);

            $article->reference = $request->input('reference');
            $article->unite_mesure = $request->input('unite_mesure');
            $article->description = $request->input('description');
            $article->categorie_id = $request->input('categorie_id');
            $article->save();
            session()->flash('success', 'تم الحفظ بنجاح');
            return redirect('/articles');
        }

        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => 'لا يمكن إدخال هذا المنتوج مرتين !!']);
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
    public function update(Request $request, $id)
    {
        try {
            $this->validate($request,[
                'reference' => 'required',
                'unite_mesure' => 'required',
                'description' => 'required',
                'categorie_name' => 'required',
                
            ]);
            $id = Categorie::where('categorie_name',$request->categorie_name)->first()->id;

            
            $article = Article::findOrFail($request->article_id);
            $article->reference = $request->input('reference');
            $article->unite_mesure = $request->input('unite_mesure');
            $article->categorie_id = $id;
            $article->description = $request->input('description');
            $article->save();
            session()->flash('success', 'تم التعديل بنجاح');
            return redirect('/articles');
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
    public function destroy(Request $request)
    {
        $article = Article::findOrFail($request->article_id);
        $article->delete();
        session()->flash('success', 'تمت عملية الحذف بنجاح');
        return redirect('/articles');
    }


    public function detail($reference)
    {
        $entrees = EntreeDetail::where('article',$reference)->sum('quantite');
        $article = Article::where('reference',$reference)->first();
        $sorties  = SortieDetail::where('article',$reference)->sum('quantite');

        return view('articles.details',compact('entrees','sorties','article'));
    }

    public function details()
    {
        $articles = Article::where('stock' ,'<',10)->get();
        return view('articles.stockAlert',compact('articles'));
    }

    public function MarkAsRead_all(){

        $userUnreadNotifications = auth()->user()->unreadNotifications->where('type' , 'App\Notifications\CheckStock');

        if($userUnreadNotifications){
            $userUnreadNotifications->markAsRead();
            return back();
        }

    }

    public function getStock(){

        $articles = Article::where('stock' ,'>', 1)->get();
        return view('stock.details',compact('articles'));
    }

    public function getStockValue(){

        $articles = Article::where('stock' ,'>', 1)->get();
        $sum = Article::sum('avg');
        return view('stock.value',compact('articles' , 'sum'));
    }

    public function getAvg($article) {
        $art = EntreeDetail::where('article' , $article)->first();
        $avg = EntreeDetail::whereBetween($art , ['2021-05-15' , now()])->avg('prix_unitaire');
        // dd($avg);
        // $avg = EntreeDetail::where('article' , $article)->avg('prix_unitaire');
        return $avg;
    }

    public function searchArticle($search)
    {
        // $results = DB::table("articles")->where("description", 'LIKE', '%' . $search . '%')->get();
        $results = Article::where("description", 'LIKE', '%'.$search.'%')->get();
        $html = view('searchProduct.search')->with(compact('results'))->render();
        // return $results;
        // return true;
        return response()->json(['success' => true, 'html' => $html]);
    }
}
