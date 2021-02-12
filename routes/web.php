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

Route::group(['middleware' => ['auth']], function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    //Route::resource('/invoices' ,'App\Http\Controllers\InvoicesController');
    Route::resource('/bonEntrees' ,'App\Http\Controllers\BonEntreeController')->middleware('auth');
    Route::resource('/bonSorties' ,'App\Http\Controllers\BonSortieController');
    Route::resource('/categories' ,'App\Http\Controllers\CategoriesController');
    Route::resource('/articles' ,'App\Http\Controllers\ArticlesController');
    Route::get('/categorie/{id}' ,'App\Http\Controllers\BonEntreeController@getproducts');
    //Route::resource('InvoiceAttachments', 'App\Http\Controllers\Invoices_AttachmentController');
    //Route::get('/details/{id}' ,'App\Http\Controllers\Invoices_DetailsController@show')->name('details');
    //Route::get('download/{invoice_number}/{file_name}', 'App\Http\Controllers\Invoices_DetailsController@get_file');

    Route::get('/detail/{reference}' ,'App\Http\Controllers\ArticlesController@detail')->name('detail');
    Route::get('print/{id}', 'App\Http\Controllers\BonSortieController@print')->name('print');
    Route::get('MarkAsRead_all' , 'App\Http\Controllers\ArticlesController@MarkAsRead_all')->name('MarkAsRead_all');

    //Route::get('View_file/{invoice_number}/{file_name}', 'App\Http\Controllers\Invoices_DetailsController@open_file');

    // Route::post('delete_file', 'App\Http\Controllers\Invoices_DetailsController@destroy')->name('delete_file');
    // Route::get('status_show/{id}', 'App\Http\Controllers\InvoicesController@show')->name('status_show');
    // Route::post('status_show/{id}', 'App\Http\Controllers\InvoicesController@status_update')->name('status_update');

    // Route::get('paid', 'App\Http\Controllers\InvoicesController@paid');
    // Route::get('unpaid', 'App\Http\Controllers\InvoicesController@unpaid');
    // Route::get('partial', 'App\Http\Controllers\InvoicesController@partial');

    Route::resource('/archive' ,'App\Http\Controllers\ArchiveController');
    // Route::get('print/{id}', 'App\Http\Controllers\InvoicesController@print')->name('print');
    Route::get('export_invoices', 'App\Http\Controllers\InvoicesController@export');
});   

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles','App\Http\Controllers\RoleController');
    Route::resource('users','App\Http\Controllers\UserController');
});

Route::get('invoices_report', 'App\Http\Controllers\Invoices_Reports@index');
Route::post('Search_invoices', 'App\Http\Controllers\Invoices_Reports@Search_invoices');

Route::get('customers_report', 'App\Http\Controllers\Customers_Report@index')->name("customers_report");
Route::post('Search_customers', 'App\Http\Controllers\Customers_Report@Search_customers');

///


///
Route::get('/{page}', 'App\Http\Controllers\AdminController@index');