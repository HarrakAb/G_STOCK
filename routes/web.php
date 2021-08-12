<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::group(['middleware' => ['guest']], function () {

    Route::get('/', function () {
        return view('auth.login');
    });
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/bonEntrees', 'App\Http\Controllers\BonEntreeController');
    Route::resource('/bonSorties', 'App\Http\Controllers\BonSortieController');
    Route::resource('/categories', 'App\Http\Controllers\CategoriesController');
    Route::resource('/articles', 'App\Http\Controllers\ArticlesController');
    Route::get('/categorie/{id}', 'App\Http\Controllers\BonEntreeController@getproducts');
    Route::get('/stock/{ref}', 'App\Http\Controllers\BonSortieController@getStock');
    Route::resource('/clients', 'App\Http\Controllers\ClientsController');
    Route::get('/client/{name}', 'App\Http\Controllers\ClientsController@getClient');
    Route::get('/client/{search}', 'App\Http\Controllers\ClientsController@searchClient');
    Route::resource('/fournisseurs', 'App\Http\Controllers\FournisseurController');
    Route::get('/fournisseur/{name}', 'App\Http\Controllers\FournisseurController@getFournisseur');
    Route::get('/article/{reference}', 'App\Http\Controllers\BonSortieController@getDescription');
    Route::get('/searticle/{id}', 'App\Http\Controllers\SearchController@getDescriptionn');
    Route::get('/searcharticle/{search}', 'App\Http\Controllers\SearchController@searchArticle');

    //etat stock
    Route::get('/stock', 'App\Http\Controllers\ArticlesController@getStock');

    // Search for Client name
    Route::get('/bonSorties/search', 'App\Http\Controllers\BonSortieController@searchClient')->name('bonSorties.searchClient');

    //stock value
    Route::get('/stockValue', 'App\Http\Controllers\ArticlesController@getStockValue');

    //get Average 
    Route::get('/getAvg/{article}', 'App\Http\Controllers\ArticlesController@getAvg');

    // detail pour chaque article
    Route::get('/detail/{reference}', 'App\Http\Controllers\ArticlesController@detail')->name('detail');

    // detail pou chaque article moin de 10 piece dans le stock
    Route::get('/details', 'App\Http\Controllers\ArticlesController@details')->name('details');

    Route::get('print/{id}', 'App\Http\Controllers\BonSortieController@print')->name('print');
    Route::get('MarkAsRead_all', 'App\Http\Controllers\ArticlesController@MarkAsRead_all')->name('MarkAsRead_all');
    Route::get('MarkAsRead', 'App\Http\Controllers\CommandeController@MarkAsRead')->name('MarkAsRead');

    Route::resource('/archive', 'App\Http\Controllers\ArchiveController');
    //Route::get('export_invoices', 'App\Http\Controllers\InvoicesController@export');


    // commande
    Route::resource('/commande', 'App\Http\Controllers\CommandeController');
    Route::get('/commandeDetail/{id}', 'App\Http\Controllers\CommandeController@getDetail');

    //Credits
    Route::resource('/credits', 'App\Http\Controllers\CreditController');
    Route::get('/credit/{code}', 'App\Http\Controllers\ClientsController@getCredit');
    Route::get('/suivi/{code}', 'App\Http\Controllers\CreditController@suivi');
    Route::get('/suiviDetails/{id}', 'App\Http\Controllers\CreditController@suiviDetails');

    //Route::get('/suivi/{code_client}' ,'App\Http\Controllers\CreditController@suivi')->name('suivi');

    // reports
    Route::get('/home/reports', 'App\Http\Controllers\HomeController@reports')->name('reports');
    Route::post('/home/checkReports', 'App\Http\Controllers\HomeController@checkReports')->name('checkReports');
    Route::post('/home/benifits', 'App\Http\Controllers\HomeController@benifits')->name('benifits');
});

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', 'App\Http\Controllers\RoleController');
    Route::resource('users', 'App\Http\Controllers\UserController');
});

// Route::get('invoices_report', 'App\Http\Controllers\Invoices_Reports@index');
// Route::post('Search_invoices', 'App\Http\Controllers\Invoices_Reports@Search_invoices');

// Route::get('customers_report', 'App\Http\Controllers\Customers_Report@index')->name("customers_report");
// Route::post('Search_customers', 'App\Http\Controllers\Customers_Report@Search_customers');

///


///
Route::get('/{page}', 'App\Http\Controllers\AdminController@index');
