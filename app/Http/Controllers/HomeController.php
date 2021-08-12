<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\BonEntree;
use App\Models\BonSortie;
use App\Models\EntreeDetail;
use App\Models\SortieDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $sortiesMonthly = SortieDetail::whereBetween('created_at', [now()->startOfMonth() , now()])->get();
        $sortiesMonthlyC = SortieDetail::whereBetween('created_at', [now()->startOfMonth() , now()])->count();

        $sortiesDaily = SortieDetail::whereBetween('created_at', [now()->startOfDay() , now()])->get();
        $sortiesDailyC = SortieDetail::whereBetween('created_at', [now()->startOfDay() , now()])->count();
        //dump($sortiesMonthlyC);
        // $sortiesDaily = SortieDetail::whereBetween('created_at', [now()->subDays(1) , now()])->get();
        // $sortiesDailyC = SortieDetail::whereBetween('created_at', [now()->subDays(1) , now()])->count();

        // $sortiesYearly = SortieDetail::whereBetween('created_at', [now()->startOfYear() , now()])->get();
        // $sortiesYearlyC = SortieDetail::whereBetween('created_at', [now()->startOfYear() , now()])->count();

        // dd($sortiesDailyC);
        // for every day
        // for ($i = 0; $i < $sortiesDailyC ; $i++) {

        //     $prix_unit = $sortiesDaily[$i]['prix_unitaire'] ;
        //     $qte = $sortiesDaily[$i]['quantite'] ;
        //     $art = $sortiesDaily[$i]['description'] ;
        //     $prix_vente = $sortiesDaily[$i]['prix_total'] ;

        //     $avg = EntreeDetail::where('description' , $art)->avg('prix_unitaire');

        //     $prix_achat = $avg * $qte;
        //     $benifisDaily[] = [];
        //     $benifisDaily[$i] = $prix_vente - $prix_achat; 
            
        //     // dump($benifisDaily[$i]);
                
        // }
        // $benifisDaily = array_sum($benifisDaily);
        // dump('total',$benifisDaily);

        // // for every month
        // for ($i = 0; $i < $sortiesMonthlyC ; $i++) {

        //     $prix_unit = $sortiesMonthly[$i]['prix_unitaire'] ;
        //     $qte = $sortiesMonthly[$i]['quantite'] ;
        //     $art = $sortiesMonthly[$i]['description'] ;
        //     $prix_vente = $sortiesMonthly[$i]['prix_total'] ;

        //     $avg = EntreeDetail::where('description' , $art)->avg('prix_unitaire');

        //     $prix_achat = $avg * $qte;
        //     $benifisMonthly[] = [];
        //     $benifisMonthly[$i] = $prix_vente - $prix_achat;         
              
        // }

        // $benifisMonthly = array_sum($benifisMonthly);

        // // for every year
        // for ($i = 0; $i < $sortiesYearlyC ; $i++) {

        //     $prix_unit = $sortiesYearly[$i]['prix_unitaire'] ;
        //     $qte = $sortiesYearly[$i]['quantite'] ;
        //     $art = $sortiesYearly[$i]['description'] ;
        //     $prix_vente = $sortiesYearly[$i]['prix_total'] ;

        //     $avg = EntreeDetail::where('description' , $art)->avg('prix_unitaire');

        //     $prix_achat = $avg * $qte;
        //     $benifisYearly[] = [];
        //     $benifisYearly[$i] = $prix_vente - $prix_achat;         
                
        // }

        // $benifisYearly = array_sum($benifisYearly);


        // every year
        $entreeYearly = BonEntree::whereBetween('created_at', [now()->startOfYear() , now()])->sum('total');
        $sortieYearly = BonSortie::whereBetween('created_at', [now()->startOfYear() , now()])->sum('total');

        // every month
        $entreeMonthly = BonEntree::whereBetween('created_at', [now()->startOfMonth() , now()])->sum('total');
        $sortieMonthly = BonSortie::whereBetween('created_at', [now()->startOfMonth() , now()])->sum('total');

        // every day 
        $entreeDaily = BonEntree::whereBetween('created_at', [now()->startOfDay() , now()])->sum('total');
        $sortieDaily= BonSortie::whereBetween('created_at', [now()->startOfDay() , now()])->sum('total');

        $benifisDaily = $sortieDaily - $entreeDaily;
        $benifitsMonthly = $sortieMonthly - $entreeMonthly;
        $benifitsYearly = $sortieYearly - $entreeYearly;

        return view('home', compact([
            'entreeDaily' , 
            'sortieDaily' , 
            'entreeMonthly',
            'sortieMonthly' , 
            'benifisDaily' , 
            'benifitsMonthly',
            'entreeYearly',
            'sortieYearly',
            'benifitsYearly'
            ]));
        // return view('home');

    }

    public function reports()
    {

        return view('report.report');
        //return view('My_Layout.scollette');

    }

    public function checkReports(Request $request){
        
        // dd($request->day);
        if($request->day){

            $date = date('d-m-Y' , strtotime($request->day));

            $sorties = BonSortie::where('bon_date' , $request->day)->get();
            $sortiesC = BonSortie::where('bon_date' , $request->day)->count();
            $benifis= SortieDetail::where('bon_date' , $request->day)->sum('benifis');
            $sumS = BonSortie::where('bon_date' , $request->day)->sum('total');
            $sumE = BonEntree::where('bon_date' , $request->day)->sum('total');

            return view('report.result' , compact('date' , 'sorties' , 'sumE' , 'sumS' , 'benifis','sortiesC' ));

        }else if($request->month && $request->year){
            $date = $request->month . ' - ' . $request->year;
            $month = $request->month;
            $year = $request->year;

            $sorties = BonSortie::whereMonth('bon_date' , $month)->whereYear('bon_date' , $year)->get();
            $sortiesC = BonSortie::whereMonth('bon_date' , $month)->whereYear('bon_date' , $year)->count();
            $benifis = SortieDetail::whereMonth('bon_date' , $month)->whereYear('bon_date' , $year)->sum('benifis');
            $sumS = BonSortie::whereMonth('bon_date' , $month)->whereYear('bon_date' , $year)->sum('total');
            $sumE = BonEntree::whereMonth('bon_date' , $month)->whereYear('bon_date' , $year)->sum('total');

            return view('report.result' , compact('date' , 'sorties' , 'sumE' , 'sumS'  , 'benifis','sortiesC'));

        }else{
            $date = $request->year;
            // $month = $request->month;
            $year = $request->year;

            //dd($month , '///' , $year);
            $sorties = BonSortie::whereYear('bon_date' , $year)->get();
            $sortiesC = BonSortie::whereYear('bon_date' , $year)->count();
            $benifis = SortieDetail::whereYear('bon_date' , $year)->sum('benifis');
            $sumS = BonSortie::whereYear('bon_date' , $year)->sum('total');
            $sumE = BonEntree::whereYear('bon_date' , $year)->sum('total');

            return view('report.result' , compact('date' , 'sorties' , 'sumE' , 'sumS' , 'benifis','sortiesC'));
        }
    }
    

    
}


// DB_DATABASE=brminfor_almacir
// DB_USERNAME=brminfor_brminfo
// DB_PASSWORD=BRMINFORMATIQUE2021
