<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    
    public function searchArticle($search)
    {
        // $results = DB::table("articles")->where("description", 'LIKE', '%' . $search . '%')->get();
        $results = Article::where("description", 'LIKE', '%'.$search.'%')->get();
        // return view('bonSorties.creeBon' , compact('results'));
        
        return $results;
        // return true;
        // return response()->json(['success' => true, 'html' => $html]);
    }

    public function getDescriptionn($id)
    {
        $descriptionn = DB::table("articles")->whereId($id)->first();
        return json_encode($descriptionn);
    }
}
