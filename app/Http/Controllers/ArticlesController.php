<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\BonEntree;
use App\Models\BonSortie;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;


class ArticlesController extends Controller
{


    // function __construct()
    // {
    //     //$this->middleware('permission:view role', ['only' => ['index', 'store']]);
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
        $this->validate($request,[
            'reference' => 'required|unique:articles|max:255',
            'description' => 'required',
            'categorie_id' => 'required'
        ]);

        $article->reference = $request->input('reference');
        $article->description = $request->input('description');
        $article->categorie_id = $request->input('categorie_id');
        $article->save();
        session()->flash('success', 'Article crée avec succés');
        return redirect('/articles');
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
        $this->validate($request,[
            'reference' => 'required',
            'description' => 'required',
            'categorie_name' => 'required',
            
        ]);
        $id = Categorie::where('categorie_name',$request->categorie_name)->first()->id;

        
        $article = Article::findOrFail($request->article_id);
        $article->reference = $request->input('reference');
        $article->categorie_id = $id;
        $article->description = $request->input('description');
        $article->save();
        session()->flash('success', 'Article modifié avec succés');
        return redirect('/articles');

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
        session()->flash('success', 'Article supprimé avec succés');
        return redirect('/articles');
    }


    public function detail($reference)
    {
        $entrees = BonEntree::where('article',$reference)->sum('quantite');
        $article = Article::where('reference',$reference)->first();
        $sorties  = BonSortie::where('article',$reference)->sum('quantite');
       // $attachments  = Invoices_Attachment::where('invoice_id',$id)->get();

        return view('articles.details',compact('entrees','sorties','article'));
    }

    public function MarkAsRead_all(){

        $userUnreadNotifications = auth()->user()->unreadNotifications;

        if($userUnreadNotifications){
            $userUnreadNotifications->markAsRead();
            return back();
        }

    }
}
