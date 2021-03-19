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
use Illuminate\Support\Facades\Notification;


class ArticlesController extends Controller
{


    // function __construct()
    // {
    //     $this->middleware('permission:view role', ['only' => ['index', 'store']]);
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
                'description' => 'required',
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
       // $attachments  = Invoices_Attachment::where('invoice_id',$id)->get();

        return view('articles.details',compact('entrees','sorties','article'));
    }

    public function details()
    {
        //$entrees = EntreeDetail::where('article',$reference)->sum('quantite');
        $articles = Article::where('stock' ,'<',10)->get();
        //$sorties  = SortieDetail::where('article',$reference)->sum('quantite');
       // $attachments  = Invoices_Attachment::where('invoice_id',$id)->get();

        return view('articles.details2',compact('articles'));
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
}
